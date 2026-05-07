<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class TripayPaymentController extends Controller
{
    private function endpoint($path)
    {
        $base = config('tripay.mode') === 'production'
            ? 'https://tripay.co.id/api'
            : 'https://tripay.co.id/api-sandbox';

        return rtrim($base, '/') . '/' . ltrim($path, '/');
    }

    public function create(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'method'     => 'required|string',
        ]);

        $user = auth()->user();
        $product = Product::findOrFail($request->product_id);

        $amount = intval($product->price);

        $order = Order::create([
            'user_id' => $user->id,
            'order_code' => 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
            'total_amount' => $amount,
            'final_amount' => $amount,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $amount,
            'subtotal' => $amount,
        ]);

        $apiKey = config('tripay.api_key');
        $privateKey = config('tripay.private_key');
        $merchantCode = config('tripay.merchant_code');

        if (!$apiKey || !$privateKey || !$merchantCode) {
            return response()->json([
                'success' => false,
                'message' => 'Konfigurasi Tripay belum lengkap. Silakan hubungi administrator.'
            ], 500);
        }

        $payload = [
            'method'         => $request->method,
            'merchant_ref'   => $order->order_code,
            'amount'         => $amount,
            'customer_name'  => $user->name,
            'customer_email' => $user->email,
            'order_items' => [
                [
                    'name'     => $product->name,
                    'price'    => $amount,
                    'quantity' => 1
                ]
            ],
            'return_url'   => route('payment.success'),
            'callback_url' => route('tripay.callback'),
            'expired_time' => now()->addHours(24)->timestamp,
            'signature'    => hash_hmac(
                'sha256',
                $merchantCode . $order->order_code . $amount,
                $privateKey
            ),
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Accept'        => 'application/json',
        ])->post($this->endpoint('/transaction/create'), $payload);

        $result = $response->json();

        if (!$result || !isset($result['success']) || $result['success'] !== true) {
            return response()->json([
                'success' => false,
                'message' => $result['message'] ?? 'Gagal membuat transaksi ke Tripay.',
                'debug_message' => $result['message'] ?? 'No message from Tripay',
                'debug_response' => $result
            ], 500);
        }

        // 🔹 Kirim Notif WA ke Admin (New Order)
        $this->sendWhatsapp(
            env('WA_ADMIN_NUMBER'),
            "🔔 *PESANAN BARU (PENDING)*\n\n" .
            "Kode: *{$order->order_code}*\n" .
            "Produk: *{$product->name}*\n" .
            "Total: *Rp " . number_format($amount, 0, ',', '.') . "*\n" .
            "Metode: *{$request->method}*\n" .
            "Customer: *{$user->name} ({$user->email})*\n\n" .
            "Status: Menunggu Pembayaran"
        );

        return response()->json([
            'success' => true,
            'payment_url' => $result['data']['checkout_url'],
            'reference'   => $result['data']['reference'],
        ]);
    }

    public function callback(Request $request)
    {
        $callback_secret = config('tripay.callback_secret');
        $signature = hash_hmac('sha256', $request->getContent(), $callback_secret);

        if ($signature !== $request->header('x-callback-signature')) {
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        $order = Order::where('order_code', $request->merchant_ref)->first();
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($request->status === 'PAID') {
            $order->update([
                'status' => 'completed',
                'payment_status' => 'paid'
            ]);

            // 🔹 Kirim Notif WA ke Admin (Payment Success)
            $this->sendWhatsapp(
                env('WA_ADMIN_NUMBER'),
                "✅ *PEMBAYARAN BERHASIL*\n\n" .
                "Kode: *{$order->order_code}*\n" .
                "Total: *Rp " . number_format($order->final_amount, 0, ',', '.') . "*\n" .
                "Metode: *{$request->payment_method}*\n" .
                "Customer: *{$order->user->name}*\n\n" .
                "Status: *LUNAS*"
            );
        } else {
            $order->update([
                'status' => strtolower($request->status),
                'payment_status' => strtolower($request->status)
            ]);
        }

        return response()->json(['success' => true]);
    }

    private function sendWhatsapp($target, $message)
    {
        $token = env('FONNTE_TOKEN');
        if (!$token || !$target) return;

        try {
            Http::withHeaders([
                'Authorization' => $token
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            \Log::error("WhatsApp Notification Error: " . $e->getMessage());
        }
    }
}
