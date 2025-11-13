@extends('layouts.admin')

@section('title', 'Kelola Transaksi')
@section('sub-title', 'Manajemen Data Transaksi Customer')

@section('content')
<div class="container-fluid px-4">

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="fw-bold mb-0 text-primary">Daftar Data Transaksi</h4>

            <a href="{{ route('admin.transaksi.export') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered align-middle small">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Customer</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->order_code }}</td>
                            <td>
                                {{ $order->user->name }} <br>
                                <small>{{ $order->user->email }}</small>
                            </td>
                            <td>
                                @foreach ($order->items as $item)
                                <span class="">{{ $item->product->name }}</span><br>
                                @endforeach
                            </td>

                            <td>Rp {{ number_format($order->final_amount, 0, ',', '.') }}</td>

                            <td>{{ ucfirst($order->payment_method) }}</td>

                            <td>
                                @if($order->payment_status == 'paid')
                                <span class="badge bg-success">Paid</span>
                                @elseif($order->payment_status == 'unpaid')
                                <span class="badge bg-warning text-white">Pending</span>
                                @elseif($order->payment_status == 'failed')
                                <span class="badge bg-danger">Failed</span>
                                @else
                                <span class="badge bg-light">{{ $order->payment_status }}</span>
                                @endif
                            </td>

                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>

                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $order->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="{{ route('order.invoice', $order->order_code) }}"
                                    class="btn btn-primary btn-sm">
                                    <i data-feather="file"></i>
                                </a>
                                <button class="btn btn-danger btn-sm delete-order-btn"
                                    data-id="{{ $order->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- MODAL DETAIL --}}
                        <div class="modal fade" id="modalDetail{{ $order->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header bg-primary" style="color: #ffff;">
                                        <h5 class="modal-title">Detail Transaksi - {{ $order->order_code }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <h6 class="fw-bold mb-2">Data Customer</h6>
                                        <p class="mb-1">Nama: {{ $order->user->name }}</p>
                                        <p>Email: {{ $order->user->email }}</p>

                                        <hr>

                                        <h6 class="fw-bold">Produk Dipesan</h6>
                                        <ul class="list-group mb-3">
                                            @foreach($order->items as $item)
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                                <strong>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                                            </li>
                                            @endforeach
                                        </ul>

                                        <p><strong>Total Akhir :</strong> Rp {{ number_format($order->final_amount, 0, ',', '.') }}</p>

                                        <hr>

                                        <h6 class="fw-bold">Status Pembayaran</h6>
                                        <p>{{ ucfirst($order->payment_status) }}</p>

                                        @if($order->payment)
                                        <h6 class="fw-bold mt-3">Detail Pembayaran:</h6>
                                        @foreach($order->payment as $payments)
                                        <p><strong>Payment Type:</strong> {{ $payments->payment_type }}</p>
                                        <p><strong>Status:</strong> {{ $payments->transaction_status }}</p>
                                        @if($payment->va_number)
                                        <p><strong>VA Number:</strong> {{ $payments->va_number }}</p>
                                        @endif
                                        @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {

        // DELETE ORDER
        document.querySelectorAll(".delete-order-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.dataset.id;

                Swal.fire({
                    title: "Yakin ingin menghapus?",
                    text: "Data transaksi akan dihapus permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!"
                }).then(result => {
                    if (result.isConfirmed) {
                        axios.delete(`/admin/orders/${id}`)
                            .then(() => {
                                Swal.fire("Dihapus!", "Transaksi berhasil dihapus.", "success")
                                    .then(() => location.reload());
                            })
                            .catch(() => Swal.fire("Gagal!", "Tidak dapat menghapus transaksi.", "error"));
                    }
                });
            });
        });
    });
</script>

@endsection