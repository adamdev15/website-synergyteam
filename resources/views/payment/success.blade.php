@extends('layouts.landing')

@section('title', 'Pembayaran Berhasil')

@section('content')
<section class="d-flex align-items-center justify-content-center" style="min-height: 80vh; background-color: #f8fafc;">
    <div class="text-center p-4">
        <div class="mb-4">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
        </div>
        <h2 class="fw-bold mb-3" style="color: #0c54b7;">Pembayaran Berhasil 🎉</h2>
        <p class="text-muted mb-4">
            Terima kasih telah melakukan pembayaran. Pesanan Anda sedang kami proses.
        </p>

        <a href="{{ url('/') }}" class="btn btn-primary px-4 py-2">
            <i class="bi bi-house-door me-2"></i> Kembali ke Beranda
        </a>
    </div>
</section>

<style>
    section {
        animation: fadeInUp 0.8s ease-in-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

@endsection