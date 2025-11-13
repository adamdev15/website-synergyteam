@extends('layouts.landing')

@section('title', 'API Integration & App - Synergy Team')

@section('content')
{{-- ================= HERO SECTION ================= --}}
<section class="container-fluid hero-section position-relative overflow-hidden py-5">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-7 px-1 px-lg-5 text-white">
                <h1 class="display-4 fw-bold mb-4">API Integration & App</h1>
                <p class="lead mb-4">
                    Layanan integrasi API dan pengembangan aplikasi custom untuk mendukung transformasi digital bisnis Anda.
                    Tingkatkan efisiensi, konektivitas, dan otomatisasi sistem dengan solusi andal dari SynergyTeam.id.
                </p>
                <div class="hero-buttons">
                    <a href="#layanan-jasa-api" class="btn btn-warning btn-lg me-3 px-4 py-3 fw-semibold text-white">
                        Order Layanan →
                    </a>
                    <a href="https://wa.me/6285713296692?text={{ urlencode('Halo admin, saya tertarik dengan layanan API Integration & App. Mohon informasi lebih lanjut.') }}"
                       target="_blank" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold">
                        Hubungi Admin →
                    </a>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <img src="{{ asset('assets/img/ilustrasi/api-integration.png') }}" 
                     alt="API Integration Synergy Team"
                     class="img-fluid rounded-3" style="width:480px; z-index:2;">
            </div>
        </div>
    </div>
</section>

{{-- ================= WHY SECTION ================= --}}
<section class="why-section bg-white py-5" id="layanan-jasa-api">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <h2 class="fw-bold mb-4 text-center">
                    Mengapa Harus Memakai API Integration di <span class="text-primary">Synergy Team</span>
                </h2>

                <div class="row g-3">
                    @foreach([
                        [
                            'icon' => 'bi-box-seam text-primary',
                            'title' => 'One Project Solution',
                            'desc' => 'Semua kebutuhan solusi Anda terpenuhi di satu tempat',
                        ],
                        [
                            'icon' => 'bi-person-badge text-success',
                            'title' => 'Tim Profesional',
                            'desc' => 'Dikerjakan oleh Developer berpengalaman di bidangnya',
                        ],
                        [
                            'icon' => 'bi-chat-dots text-warning',
                            'title' => 'Konsultasi Gratis',
                            'desc' => 'Kami siap membantu Anda mewujudkan ide menjadi solusi digital',
                        ],
                        [
                            'icon' => 'bi-cash-coin text-danger',
                            'title' => 'Harga Kompetitif',
                            'desc' => 'Kualitas premium dengan harga tetap bersahabat',
                        ],
                    ] as $feature)
                        <div class="col-lg-4 col-md-6 col-6 col-sm-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm p-3">
                                <div class="icon-circle mb-3 d-flex align-items-center justify-content-center">
                                    <i class="bi {{ $feature['icon'] }}" style="font-size: 2rem;"></i>
                                </div>
                                <h6 class="h-title fw-bold text-dark mb-2">{{ $feature['title'] }}</h6>
                                <p class="h-p text-muted small mb-0">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <a href="https://wa.me/6285713296692?text={{ urlencode('Halo SynergyTeam, saya tertarik dengan layanan API Integration. Bisa dijelaskan lebih lanjut?') }}"
                       target="_blank" class="btn btn-success px-4 py-3 fw-semibold">📞 Hubungi Kami</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('assets/img/ilustrasi-why.webp') }}" alt="Mengapa Synergy Team" class="img-fluid">
            </div>
        </div>
    </div>
</section>

{{-- ================= CTA SECTION ================= --}}
<section class="container text-white position-relative overflow-hidden shadow-sm my-5"
         style="background:linear-gradient(135deg,#126ebb 0%,#0c54b7 100%);
         border-radius:20px;padding:60px 30px;">
    <div class="text-center">
        <h2 class="fw-bold mb-4">Saatnya Ide Anda menjadi Solusi Profesional di Era Digital</h2>
        <p class="lead mb-5">
            Bangun ide Anda menjadi solusi digital yang profesional dan berinovasi.
            Synergyteam.id siap membantu Anda membangun website, sistem, atau aplikasi sesuai kebutuhan Anda —
            baik untuk bisnis, institusi, maupun pendidikan.
        </p>
        <div class="cta d-flex justify-content-center gap-4 flex-wrap">
            <a href="{{ url('/pembuatan-website') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold shadow"
               style="border-radius:50px;">🚀 Bangun Website Sekarang</a>
            <a href="{{ url('/kontak-kami') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold"
               style="border-radius:50px;">📞 Konsultasi Gratis</a>
        </div>
    </div>

    <div class="position-absolute top-0 end-0"
         style="width:200px;height:200px;background:rgba(255,255,255,0.1);
         border-radius:50%;animation:float 15s ease-in-out infinite reverse;"></div>
</section>
@endsection
