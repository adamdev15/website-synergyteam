@extends('layouts.landing')

@section('title', 'Hosting & Domain - Synergy Team')

@section('content')
{{-- ================= HERO SECTION ================= --}}
<section class="container-fluid hero-section position-relative overflow-hidden py-5">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-12 px-1 px-lg-5 text-white">
                <h1 class="display-4 fw-bold mb-4">Hosting & Domain</h1>
                <p class="lead mb-4">
                    Optimalkan performa website Anda dengan hosting cepat, aman, dan stabil dari SynergyTeam.id.
                    Kami juga menyediakan layanan domain profesional untuk mendukung kehadiran digital bisnis Anda.
                </p>
                <div class="hero-buttons">
                    <a href="#layanan-hosting" class="btn btn-warning btn-lg me-3 px-4 py-3 fw-semibold text-white">
                        Cek Layanan →
                    </a>
                    <a href="https://wa.me/6285713296692?text={{ urlencode('Halo admin, saya tertarik dengan layanan Hosting & Domain. Mohon informasi lebih lanjut.') }}"
                       target="_blank" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold">
                        Hubungi Admin →
                    </a>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 text-center">
                <div class="position-relative">
                    <svg viewBox="0 0 300 300"
                        style="position:absolute;top:50%;left:50%;width:300px;height:300px;transform:translate(-50%,-50%);z-index:1;"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="150" cy="150" r="140" fill="#ffffff15" />
                    </svg>
                    <img src="{{ asset('assets/img/ilustrasi/hosting-domain.png') }}"
                         alt="Hosting & Domain Synergy Team"
                         class="img-fluid position-relative"
                         style="width:520px;z-index:2;">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= SECTION DETAIL ================= --}}
<section id="layanan-hosting" class="py-5 bg-light">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4" style="color:#0c54b7;">Hosting Cepat & Domain Profesional</h2>
                <p class="lead text-muted mb-4">
                    Layanan kami memberikan performa server yang cepat, uptime tinggi,
                    serta domain yang sesuai dengan identitas bisnis Anda. Dukung
                    pertumbuhan digital dengan layanan hosting dan domain yang handal.
                </p>
                <img src="https://via.placeholder.com/800x400/126ebb/ffffff?text=Hosting+%26+Domain"
                     alt="Hosting & Domain"
                     class="img-fluid rounded shadow">
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
