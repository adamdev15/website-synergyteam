@extends('layouts.landing')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4" style="color: #0c54b7;"><i class="bi bi-clock-history me-2"></i>Riwayat Transaksi</h2>

    @if($orders->count() > 0)
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatablesSimple" class="table table-bordered align-middle">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode Order</th>
                        <th>Produk</th>
                        <th>Total</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index => $order)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td><strong>{{ $order->order_code }}</strong></td>
                        <td class="text-center">
                            @foreach ($order->items as $item)
                            <div>{{ $item->product->name }} (x{{ $item->quantity }})</div>
                            @endforeach
                        </td>
                        <td class="text-center">Rp {{ number_format($order->final_amount, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if($order->payment_status === 'paid')
                            <span class="badge bg-success text-white">Paid</span>
                            @elseif($order->payment_status === 'unpaid')
                            <span class="badge bg-warning text-white">Pending</span>
                            @elseif($order->payment_status === 'failed')
                            <span class="badge bg-danger text-white">Failed</span>
                            @else
                            <span class="badge bg-secondary">{{ ucfirst($order->payment_status) }}</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#orderDetail{{ $order->id }}">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>

                    {{-- Modal Detail Pesanan --}}
                    <div class="modal fade" id="orderDetail{{ $order->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header text-white" style="background-color: #0c54b7;">
                                    <h5 class="modal-title">Detail Pesanan #{{ $order->order_code }}</h5>
                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Status Pembayaran:</strong>
                                        <span class="badge 
                                                @if($order->payment_status === 'paid') bg-success
                                                @elseif($order->payment_status === 'unpaid') bg-warning text-white
                                                @else bg-danger @endif">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </p>

                                    <p><strong>Total:</strong> Rp {{ number_format($order->final_amount, 0, ',', '.') }}</p>
                                    <hr>

                                    <h6 class="fw-bold">Produk Dipesan:</h6>
                                    <ul class="list-group mb-3">
                                        @foreach($order->items as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center alert alert-info">
                                            <span>{{ $item->product->name }}</span>
                                            <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                        </li>
                                        @endforeach
                                    </ul>

                                    @if($order->payment_status === 'paid')
                                        <hr>
                                        <h6 class="fw-bold text-success"><i class="bi bi-cloud-download me-1"></i> Link Download</h6>

                                        @foreach($order->items as $item)
                                            @if($item->product->link_drive)
                                                <div class="alert alert-success d-flex justify-content-between align-items-center">
                                                    <span>
                                                        <strong>{{ $item->product->name }}</strong><br>
                                                        <a href="{{ $item->product->link_drive }}" target="_blank">
                                                            {{ $item->product->link_drive }}
                                                        </a>
                                                    </span>

                                                    <button class="btn btn-outline-primary btn-sm"
                                                            onclick="copyToClipboard('{{ $item->product->link_drive }}')">
                                                        <i class="bi bi-clipboard"></i> Copy
                                                    </button>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    @if($order->payment)
                                    <h6 class="fw-bold">Detail Pembayaran:</h6>

                                    <p><strong>Metode:</strong> {{ strtoupper($order->payment->payment_type ?? '-') }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($order->payment->transaction_status ?? '-') }}</p>

                                    @if($order->payment->va_number)
                                    <p><strong>VA Number:</strong> {{ $order->payment->va_number }}</p>
                                    @endif

                                    @else
                                    <p class="text-muted">Belum ada data pembayaran.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info text-center shadow-sm">
            <i class="bi bi-info-circle me-2"></i>Belum ada transaksi yang tercatat.
        </div>
        @endif
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        Swal.fire({
            icon: 'success',
            title: 'Link berhasil disalin!',
            text: text,
            timer: 1500,
            showConfirmButton: false
        });
    });
}
</script>

@endsection