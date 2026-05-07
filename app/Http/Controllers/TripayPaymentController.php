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

        return $base . $path;
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
                config('tripay.merchant_code') . $order->order_code . $amount,
                config('tripay.private_key')
            ),
        ];

        $response = Http::withToken(config('tripay.api_key'))
            ->post($this->endpoint('/transaction/create'), $payload);

        $result = $response->json();

        if (!$result || !isset($result['success']) || $result['success'] !== true) {
            return response()->json([
                'success' => false,
                'message' => $result['message'] ?? 'Gagal membuat transaksi Tripay',
                'debug'   => $result
            ], 500);
        }

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
        } else {
            $order->update([
                'status' => strtolower($request->status),
                'payment_status' => strtolower($request->status)
            ]);
        }

        return response()->json(['success' => true]);
    }
}
