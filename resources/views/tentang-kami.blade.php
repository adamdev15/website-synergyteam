@extends('layouts.landing')

@section('title', 'Tentang Kami - Synergy Team')

@section('content')
    {{-- ============ HERO SECTION ============ --}}
    <section class="py-5 position-relative overflow-hidden"
             style="background:linear-gradient(135deg,#126ebb 0%,#0c54b7 100%);">
        <div class="container">
            <div class="row align-items-center min-vh-50">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img src="{{ asset('assets/img/ilustrasi-why.webp') }}" alt="Tentang Synergyteam.id"
                         class="img-fluid" style="max-height:450px;animation:float 8s ease-in-out infinite;">
                </div>
                <div class="col-lg-7 text-white">
                    <h1 class="display-4 fw-bold mb-4">Tentang Synergyteam.id</h1>
                    <p class="lead mb-4">
                        Platform mitra terpercaya dalam mengembangkan solusi digital untuk kebutuhan teknologi Anda.
                        Kami menyediakan layanan profesional untuk membantu Anda membangun dan mengoptimalkan proyek digital
                        Anda dengan berbagai layanan inovatif.
                    </p>
                    <a href="#layanan-kami" class="btn btn-light btn-lg me-3 shadow">Pelajari Lebih Lanjut</a>
                    <a href="{{ url('/kontak-kami') }}" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
                </div>
            </div>
        </div>

        {{-- Background decorative circles --}}
        <div class="position-absolute" style="top:-50px;right:-50px;width:200px;height:200px;
             background:rgba(255,255,255,0.1);border-radius:50%;animation:float 10s ease-in-out infinite;"></div>
        <div class="position-absolute" style="bottom:-30px;left:-30px;width:150px;height:150px;
             background:rgba(255,255,255,0.1);border-radius:50%;animation:float 12s ease-in-out infinite reverse;"></div>
    </section>

    {{-- ============ SEJARAH SINGKAT ============ --}}
    <section class="py-5">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-4" style="color:#126ebb;">Sejarah Singkat</h2>
            <div class="underline mx-auto mb-4"
                 style="width:80px;height:3px;background:linear-gradient(90deg,#126ebb,#0c54b7);"></div>
            <p class="fs-5 text-muted mb-4 lh-lg">
                Synergyteam.id adalah platform baru yang dibangun oleh tim profesional dengan pengalaman lebih dari 5 tahun
                dalam menghadirkan berbagai solusi digital. Kami berkomitmen menyediakan layanan inovatif dan terintegrasi
                untuk memenuhi kebutuhan digital bisnis, pendidikan, serta berbagai kebutuhan teknologi lainnya.
            </p>
            <p class="fs-5 text-muted lh-lg">
                Dengan pengalaman tersebut, Synergyteam.id telah dipercaya oleh berbagai klien di Indonesia dalam pengembangan
                sistem administrasi, aplikasi, website, dan layanan teknologi yang mendukung transformasi digital secara menyeluruh.
            </p>
        </div>
    </section>

    {{-- ============ LAYANAN KAMI ============ --}}
    <section id="layanan-kami" class="py-5">
        <div class="container text-center mb-5">
            <h2 class="display-5 fw-bold mb-4" style="color:#0c54b7;">Layanan Kami</h2>
            <div class="underline mx-auto mb-4"
                 style="width:80px;height:3px;background:linear-gradient(90deg,#126ebb,#0c54b7);"></div>
            <p class="lead text-muted">
                Kami menyediakan berbagai layanan profesional untuk membantu Anda membangun dan mengoptimalkan proyek digital.
            </p>
        </div>

        <div class="container">
            <div class="row">
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="{{ url($service['path']) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm service-card text-center p-4">
                                <div class="service-icon mb-3 mx-auto d-flex align-items-center justify-content-center"
                                     style="width:80px;height:80px;border-radius:50%;overflow:hidden;">
                                    <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}"
                                         style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                                </div>
                                <h5 class="fw-bold mb-3 text-dark">{{ $service['title'] }}</h5>
                                <p class="text-muted">{{ $service['description'] }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ CALL TO ACTION ============ --}}
    <section class="container text-white position-relative overflow-hidden shadow-sm my-5"
             style="background:linear-gradient(135deg,#126ebb 0%,#0c54b7 100%);
             border-radius:20px;padding:60px 30px;">
        <div class="text-center position-relative">
            <h2 class="fw-bold mb-4">Saatnya Ide Anda menjadi Solusi Profesional di Era Digital</h2>
            <p class="lead mb-5">
                Bangun ide Anda menjadi solusi digital yang profesional dan berinovasi.
                Synergyteam.id siap membantu Anda membangun website, sistem, atau aplikasi sesuai kebutuhan Anda —
                baik untuk bisnis, institusi, maupun pendidikan.
            </p>
            <div class="d-flex justify-content-center gap-4 flex-wrap">
                <a href="{{ url('/pembuatan-website') }}"
                   class="btn btn-light btn-lg px-5 py-3 fw-bold shadow" style="border-radius:50px;">
                    🚀 Bangun Website Sekarang
                </a>
                <a href="{{ url('/kontak-kami') }}"
                   class="btn btn-outline-light btn-lg px-5 py-3 fw-bold" style="border-radius:50px;">
                    📞 Konsultasi Gratis
                </a>
            </div>
        </div>

        <div class="position-absolute top-0 end-0"
             style="width:200px;height:200px;background:rgba(255,255,255,0.1);
             border-radius:50%;animation:float 15s ease-in-out infinite reverse;"></div>
    </section>
@endsection
