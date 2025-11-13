@extends('layouts.landing')

@section('title', 'Jasa Coding Profesional - Synergy Team')

@section('content')
{{-- ================= HERO SECTION ================= --}}
<section class="container-fluid hero-section position-relative overflow-hidden py-5">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-7 px-1 px-lg-5 text-white">
                <h1 class="display-4 fw-bold mb-4">Jasa Coding Profesional</h1>
                <p class="lead mb-4">
                    Solusi jasa coding terpercaya untuk website, aplikasi mobile, dan integrasi sistem sesuai kebutuhan Anda.
                    Tim berpengalaman SynergyTeam.id siap mewujudkan ide digital Anda menjadi produk yang fungsional, inovatif, dan berkualitas tinggi.
                </p>
                <div class="hero-buttons">
                    <a href="#layanan-jasa-coding" class="btn btn-warning btn-lg me-3 px-4 py-3 fw-semibold text-white">
                        Cek Layanan →
                    </a>
                    <a href="https://wa.me/6285713296692?text={{ urlencode('Halo admin, saya tertarik dengan jasa coding profesional. Mohon informasi lebih lanjut.') }}"
                       target="_blank" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold">
                        Hubungi Admin →
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/img/ilustrasi/jasacodingg.jpg') }}" alt="Jasa Coding"
                     class="img-fluid rounded-3" style="width:450px; z-index:2;">
            </div>
        </div>
    </div>
</section>

{{-- ================= WHY SECTION ================= --}}
<section class="why-section bg-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <h3 class="fw-bold mb-4 text-center">
                    Mengapa Harus Memakai Jasa Coding di <span class="text-primary">Synergy Team</span>
                </h3>
                <div class="row g-3">
                    @foreach([
                        ['icon' => 'bi-box-seam text-primary', 'title' => 'One Project Solution', 'desc' => 'Semua kebutuhan solusi Anda terpenuhi di satu tempat'],
                        ['icon' => 'bi-person-badge text-success', 'title' => 'Tim Profesional', 'desc' => 'Dikerjakan oleh developer berpengalaman'],
                        ['icon' => 'bi-chat-dots text-warning', 'title' => 'Konsultasi Gratis', 'desc' => 'Kami siap membantu Anda mewujudkan ide menjadi solusi digital'],
                        ['icon' => 'bi-cash-coin text-danger', 'title' => 'Harga Kompetitif', 'desc' => 'Kualitas premium dengan harga tetap bersahabat'],
                    ] as $why)
                        <div class="col-lg-4 col-md-6 col-6 col-sm-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm p-3 text-center">
                                <div class="icon-circle mb-3 d-flex align-items-center justify-content-center">
                                    <i class="bi {{ $why['icon'] }}" style="font-size:2rem;"></i>
                                </div>
                                <h6 class="h-title fw-bold">{{ $why['title'] }}</h6>
                                <p class="h-p text-muted small mb-0">{{ $why['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="https://wa.me/6285713296692?text={{ urlencode('Halo, saya tertarik dengan layanan coding di SynergyTeam. Bisa dijelaskan lebih lanjut?') }}"
                       target="_blank" class="btn btn-success px-4 py-3 fw-semibold">📞 Hubungi Kami</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('assets/img/ilustrasi-why.webp') }}" alt="Mengapa Synergy Team" class="img-fluid">
            </div>
        </div>
    </div>
</section>

{{-- ================= LAYANAN CODING ================= --}}
<section id="layanan-jasa-coding" class="py-5 bg-light">
    <div class="container text-center mb-5">
        <h2 class="fw-bold" style="color:#0c54b7;">Layanan Coding</h2>
        <p class="text-muted">Kami hadir dengan berbagai layanan coding sesuai kebutuhan Anda.</p>
    </div>
    <div class="container">
        <div class="row">
            @foreach($services as $service)
                @php
                    $waLink = "https://wa.me/6285713296692?text=" . urlencode($service['waMessage']);
                @endphp
                <div class="col-lg-4 col-md-6 col-6 col-sm-6 mb-44">
                    <div class="card h-100 shadow-sm border-0 text-center p-3">
                        <div class="mb-3">
                            <i class="{{ $service['icon'] }} text-primary" style="font-size:2rem;"></i>
                        </div>
                        <h5 class="h-title">{{ $service['title'] }}</h5>
                        <p class="h-p text-muted small">{{ $service['desc'] }}</p>
                        <div class="d-flex justify-content-center align-items-center gap-2 mt-auto">
                            <span class="h-p fw-semibold small text-primary">{{ $service['price'] }}</span>
                            <a href="{{ $waLink }}" target="_blank" class="h-order btn btn-primary btn-sm fw-semibold">Order</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PORTFOLIO ================= --}}
<section class="py-5 bg-light">
    <div class="container text-center mb-5">
        <h2 class="fw-bold" style="color:#0c54b7;">Portfolio</h2>
        <p class="text-muted">Beberapa hasil pekerjaan tim kami</p>
    </div>
    <div class="container">
        <div class="row">
            @foreach($portfolios as $p)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset($p['img']) }}" class="card-img-top" alt="{{ $p['title'] }}">
                        <div class="card-body d-flex flex-column">
                            <h5>{{ $p['title'] }}</h5>
                            <p class="text-muted small flex-grow-1">{{ $p['desc'] }}</p>
                            <ul class="text-muted small">
                                @foreach($p['features'] as $f)
                                    <li>{{ $f }}</li>
                                @endforeach
                            </ul>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="fw-semibold text-primary small">{{ $p['price'] }}</span>
                                <a href="{{ $p['demoLink'] }}" target="_blank" class="btn btn-primary btn-sm">Demo</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
