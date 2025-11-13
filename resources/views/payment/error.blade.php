@extends('layouts.landing')

@section('title', 'Terjadi Kesalahan Pembayaran')

@section('content')
<section class="d-flex align-items-center justify-content-center" style="min-height: 80vh; background-color: #fff5f5;">
    <div class="text-center p-4">
        <div class="mb-4">
            <i class="bi bi-x-circle-fill text-danger" style="font-size: 4rem;"></i>
        </div>
        <h2 class="fw-bold mb-3 text-danger">Terjadi Kesalahan ❌</h2>
        <p class="text-muted mb-4">
            Maaf, terjadi kesalahan saat memproses pembayaran Anda. Silakan coba lagi atau hubungi admin kami untuk bantuan lebih lanjut.
        </p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ url('/produk') }}" class="btn btn-outline-danger px-4 py-2">
                <i class="bi bi-arrow-left-circle me-2"></i> Coba Lagi
            </a>
            <a href="https://wa.me/6285713296692?text={{ urlencode('Halo admin, saya mengalami kendala pada pembayaran Midtrans.') }}"
                target="_blank"
                class="btn btn-success px-4 py-2">
                <i class="bi bi-whatsapp me-2"></i> Hubungi Admin
            </a>
        </div>
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