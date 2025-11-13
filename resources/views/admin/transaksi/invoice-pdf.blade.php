<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pesanan {{ $order->order_code }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top:20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background: #f5f5f5; }
        .total { text-align: right; font-weight: bold; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Pesanan</h2>
<p><strong>No. Pesanan:</strong> {{ $order->order_code }}</p>
<p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>

<hr>

<h3>Data Customer</h3>
<p>Nama: {{ $order->user->name }}</p>
<p>Email: {{ $order->user->email }}</p>

<hr>

<h3>Detail Pesanan</h3>
<table class="table">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>Rp {{ number_format($item->price,0,',','.') }}</td>
            <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3 class="total">TOTAL: Rp {{ number_format($order->final_amount, 0, ',', '.') }}</h3>

<hr>
<p style="text-align:center;">Terima kasih telah bertransaksi dengan SynergyTeam.id</p>

</body>
</html>
