@extends('layouts.guest')

@section('title', 'Verifikasi Email - Synergy Team')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
    <div class="card shadow-sm p-4" style="width: 440px; max-width: 95%; border-radius: 16px; border: none;">
        <img src="{{ asset('assets/img/logosynergyteam.png') }}" alt="Logo Synergy Team" style="width: 60px;" class="mx-auto d-block mb-2">
        <h5 class="text-center mb-2 fw-semibold" style="color: #0c54b7;">Verifikasi Email Anda</h5>
        <p class="text-muted small text-center mb-4">
            Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan. Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkannya lagi.
        </p>

        @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success small mb-4" role="alert">
            Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
        </div>
        @endif

        <div class="d-flex flex-column gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold" style="border-radius: 10px; background-color: #0c54b7; border-color: #0c54b7;">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit" class="btn btn-link text-muted small text-decoration-none">
                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
