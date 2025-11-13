@extends('layouts.landing')

@section('title', 'Halaman Pembayaran - Synergy Team')

@section('content')
<div class="pembayaran-page position-relative" style="min-height:100vh;">
    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center"
         style="background-color:rgba(255,255,255,0.9);z-index:10;">
        <img src="{{ asset('assets/img/maintenance.png') }}" alt="Under Development" style="width:300px;margin-bottom:20px;">
        <h2 class="fw-bold" style="color:#0c54b7;">Halaman Sedang Dalam Pengembangan</h2>
        <p class="text-muted">Kami sedang menyiapkan fitur pembayaran online dengan Midtrans 🚧</p>
    </div>
</div>
@endsection
