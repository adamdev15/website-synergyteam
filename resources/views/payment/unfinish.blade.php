@extends('layouts.landing')

@section('title', 'Pembayaran Belum Selesai')

@section('content')
<section class="d-flex align-items-center justify-content-center" style="min-height: 80vh; background-color: #fffdf5;">
    <div class="text-center p-4">
        <div class="mb-4">
            <i class="bi bi-hourglass-split text-warning" style="font-size: 4rem;"></i>
        </div>
        <h2 class="fw-bold mb-3" style="color: #f39c12;">Pembayaran Belum Selesai ⚠️</h2>
        <p class="text-muted mb-4">
            Anda belum menyelesaikan proses pembayaran. Silakan selesaikan pembayaran Anda agar pesanan dapat diproses.
        </p>

        <a href="{{ url('/produk') }}" class="btn btn-warning text-white px-4 py-2">
            <i class="bi bi-cart-check me-2"></i> Lanjutkan Pembayaran
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