<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans otomatis
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createSnapToken(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = auth()->user();
        $product = Product::findOrFail($request->product_id);

        // Buat Order baru
        $order = Order::create([
            'user_id' => $user->id,
            'order_code' => 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
            'total_amount' => $product->price,
            'discount_amount' => 0,
            'final_amount' => $product->price,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        // Buat Order Item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
            'subtotal' => $product->price,
        ]);

        // Parameter untuk Snap Token Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $order->final_amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => $product->id,
                    'price' => $product->price,
                    'quantity' => 1,
                    'name' => $product->name,
                ]
            ],
        ];

        // Buat Snap Token
        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'success' => true,
            'snap_token' => $snapToken,
            'order_code' => $order->order_code,
        ]);
    }

    // Handle callback dari Midtrans
    public function callback(Request $request)
{
    $serverKey = config('midtrans.server_key');
    $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

    if ($hashed !== $request->signature_key) {
        return response()->json(['message' => 'Invalid signature'], 403);
    }

    $order = Order::where('order_code', $request->order_id)->first();

    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    // Simpan ke tabel payments (opsional)
    $order->payment()->create([
        'transaction_id' => $request->transaction_id,
        'payment_type' => $request->payment_type,
        'transaction_status' => $request->transaction_status,
        'fraud_status' => $request->fraud_status,
        'gross_amount' => $request->gross_amount,
        'response' => json_encode($request->all()),
    ]);

    // Update status order sesuai status transaksi
    $status = $request->transaction_status;
    if (in_array($status, ['capture', 'settlement'])) {
        $order->update([
            'status' => 'completed',
            'payment_status' => 'paid',
        ]);
    } elseif (in_array($status, ['deny', 'cancel', 'expire'])) {
        $order->update([
            'status' => 'failed',
            'payment_status' => 'failed',
        ]);
    } elseif ($status == 'pending') {
        $order->update([
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);
    }

    return response()->json(['message' => 'Callback processed']);
}

}
