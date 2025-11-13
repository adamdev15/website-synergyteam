@extends('layouts.admin')

@section('title', 'Detail User')
@section('sub-title', 'Informasi lengkap pengguna')

@section('content')
<div class="container-fluid px-4">

    <div class="card shadow-sm">

        <div class="card-body">
            <h5 class="fw-bold">Name: {{ $user->name }}</h5>
            <p class="fw-bold">Email: {{ $user->email }}</p>
            <p><strong>Terdaftar sejak:</strong> {{ $user->created_at->format('d M Y, H:i') }}</p>

            <hr>

            <h6 class="fw-bold">Riwayat Transaksi</h6>

            @if ($user->orders->count())
                <table class="table table-bordered small mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Order</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($user->orders as $o)
                            <tr>
                                <td>{{ $o->order_code }}</td>
                                <td>Rp {{ number_format($o->final_amount, 0, ',', '.') }}</td>
                                <td>{{ strtoupper($o->status) }}</td>
                                <td>{{ strtoupper($o->payment_status) }}</td>
                                <td>{{ $o->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Belum ada transaksi.</p>
            @endif

        </div>
    </div>

</div>
@endsection
