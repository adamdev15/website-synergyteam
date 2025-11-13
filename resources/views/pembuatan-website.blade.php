@extends('layouts.landing')

@section('title', 'Jasa Pembuatan Website - Synergy Team')

@section('content')
{{-- ================= HERO SECTION ================= --}}
<section class="container-fluid hero-section position-relative overflow-hidden py-5">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-7 px-1 px-lg-5 text-white">
                <h1 class="display-4 fw-bold mb-4">Jasa Pembuatan Website</h1>
                <p class="lead mb-4">
                    Kami menyediakan layanan pembuatan website modern, responsif, dan sesuai kebutuhan bisnis Anda.
                    Mulai dari website company profile hingga e-commerce profesional — tim SynergyTeam.id siap
                    membantu Anda membangun kehadiran digital yang kuat dan berkelas.
                </p>
                <div class="hero-buttons">
                    <a href="#layanan-jasa-website" class="btn btn-warning btn-lg me-3 px-4 py-3 fw-semibold text-white">
                        Order Layanan →
                    </a>
                    <a href="https://wa.me/6285713296692?text={{ urlencode('Halo SynergyTeam, saya tertarik dengan jasa pembuatan website. Mohon informasi paket dan biayanya.') }}"
                       target="_blank" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold">
                        Hubungi Admin →
                    </a>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <img src="{{ asset('assets/img/ilustrasi/sistemdevelopment.png') }}" alt="Jasa Pembuatan Website"
                     class="img-fluid rounded-3" style="width:500px; z-index:2;">
            </div>
        </div>
    </div>
</section>

{{-- ================= WHY SECTION ================= --}}
<section class="why-section bg-white py-5" id="layanan-jasa-website">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <h2 class="fw-bold mb-4 text-center">
                    Mengapa Harus Memilih Jasa Pembuatan Website di <span class="text-primary">Synergy Team</span>
                </h2>
                <div class="row g-3">
                    @foreach([
                        ['icon'=>'bi-box-seam text-primary','title'=>'One Project Solution','desc'=>'Semua kebutuhan Anda terpenuhi di satu tempat'],
                        ['icon'=>'bi-person-badge text-success','title'=>'Tim Profesional','desc'=>'Dikerjakan oleh developer berpengalaman'],
                        ['icon'=>'bi-chat-dots text-warning','title'=>'Konsultasi Gratis','desc'=>'Kami bantu Anda mewujudkan ide menjadi solusi digital'],
                        ['icon'=>'bi-cash-coin text-danger','title'=>'Harga Kompetitif','desc'=>'Kualitas premium dengan harga bersahabat']
                    ] as $item)
                        <div class="col-lg-4 col-md-6 col-6 col-sm-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm p-3 text-center">
                                <div class="icon-circle mb-3 d-flex align-items-center justify-content-center">
                                    <i class="bi {{ $item['icon'] }}" style="font-size:2rem;"></i>
                                </div>
                                <h6 class="h-tittle fw-bold">{{ $item['title'] }}</h6>
                                <p class="h-p text-muted small mb-0">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="https://wa.me/6285713296692?text={{ urlencode('Halo SynergyTeam, saya ingin memesan layanan pembuatan website. Bisa dijelaskan lebih lanjut?') }}"
                       target="_blank" class="btn btn-success px-4 py-3 fw-semibold">📞 Order Sekarang</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('assets/img/ilustrasi-why.webp') }}" alt="Mengapa Synergy Team" class="img-fluid">
            </div>
        </div>
    </div>
</section>

{{-- ================= ECO MARKET / FEATURED PROJECT ================= --}}
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="display-5 fw-bold mb-4" style="color:#126ebb;">Aplikasi Eco Market</h2>
                <div class="underline mb-4" style="width:80px;height:3px;background:linear-gradient(90deg,#126ebb,#0c54b7);"></div>
                <p class="fs-5 text-muted mb-4 lh-lg">
                    Eco Market adalah aplikasi berbasis web untuk pengelolaan bank sampah sekaligus marketplace UMKM lokal.
                    Pengguna dapat menabung sampah dan mendukung pemberdayaan UMKM setempat.
                </p>
                <h6 class="fw-bold mb-2" style="color:#126ebb;">Fitur Unggulan:</h6>
                <ul class="list-unstyled mb-4">
                    <li><span class="text-success me-2">✓</span>Manajemen Bank Sampah</li>
                    <li><span class="text-success me-2">✓</span>Marketplace UMKM</li>
                    <li><span class="text-success me-2">✓</span>Fitur Tabungan Daur Ulang</li>
                    <li><span class="text-success me-2">✓</span>PWA Notifikasi Real-time</li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <span class="fw-semibold fs-5">Harga Promo <span class="text-primary">Rp. 800.000</span></span>
                    <a href="https://wa.me/6285713296692?text={{ urlencode('Halo SynergyTeam, saya tertarik dengan layanan pembuatan sistem seperti Eco Market. Bisa dijelaskan detail harga dan estimasinya?') }}"
                       target="_blank" class="btn btn-success btn-sm fw-semibold">📞 Order Sekarang</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('assets/img/portfolio/project-1.jpg') }}" alt="Eco Market"
                     class="img-fluid rounded-3 shadow" style="max-height:500px;object-fit:contain;">
            </div>
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
            @foreach($projects as $project)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset($project['img']) }}" class="card-img-top" alt="{{ $project['title'] }}">
                        <div class="card-body d-flex flex-column">
                            <h5>{{ $project['title'] }}</h5>
                            <p class="text-muted small flex-grow-1">{{ $project['desc'] }}</p>
                            <ul class="text-muted small mb-2">
                                @foreach($project['features'] as $f)
                                    <li>{{ $f }}</li>
                                @endforeach
                            </ul>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="fw-semibold text-primary small">{{ $project['price'] }}</span>
                                <a href="{{ $project['demoLink'] }}" target="_blank" class="btn btn-primary btn-sm">Demo</a>
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
