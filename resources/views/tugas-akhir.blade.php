@extends('layouts.landing')

@section('title', 'Jasa Tugas Akhir / Skripsi - Synergy Team')

@section('content')
{{-- ================= HERO SECTION ================= --}}
<section class="container-fluid hero-section position-relative overflow-hidden py-5">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-12 px-1 px-lg-5 text-white">
                <h1 class="display-4 fw-bold mb-4">Jasa Layanan Tugas Akhir</h1>
                <p class="lead mb-4">
                    SynergyTeam.id menyediakan layanan pendampingan dan pengerjaan Tugas Akhir atau Skripsi berbasis Teknologi Informasi.
                    Kami membantu mulai dari analisis kebutuhan, pengembangan kode program, hingga penyusunan dokumentasi sesuai standar akademik.
                </p>
                <div class="hero-buttons">
                    <a href="#tugas-akhir" class="btn btn-warning btn-lg me-3 px-4 py-3 fw-semibold text-white">
                        Order Layanan →
                    </a>
                    <a href="https://wa.me/6285713296692?text={{ urlencode('Halo admin, saya tertarik dengan layanan Tugas Akhir / Skripsi. Mohon informasi lebih lanjut.') }}"
                       target="_blank" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold">
                        Hubungi Admin →
                    </a>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 text-center">
                <img src="{{ asset('assets/img/ilustrasi/ta.png') }}" 
                     alt="Jasa Tugas Akhir Synergy Team" 
                     class="img-fluid rounded-3" style="width:450px;z-index:2;">
            </div>
        </div>
    </div>
</section>

{{-- ================= WHY SECTION ================= --}}
<section class="why-section bg-white py-5" id="tugas-akhir">
    <div class="container">
        <div class="row align-items-center">
            {{-- Left Content --}}
            <div class="col-lg-6 col-md-12 pe-lg-5 mb-4 mb-lg-0">
                <div class="why-content">
                    <h3 class="fw-bold text-dark mb-4 text-center">
                        Mengapa Harus Memilih Layanan Tugas Akhir di 
                        <span class="text-primary">Synergy Team</span>
                    </h3>

                    <div class="row g-3">
                        @foreach($features as $f)
                            <div class="col-lg-4 col-md-6 col-6 col-sm-6 mb-46">
                                <div class="card h-100 border-0 shadow-sm p-3 text-center">
                                    <div class="icon-circle mb-3 d-flex align-items-center justify-content-center">
                                        <i class="bi {{ $f['icon'] }}" style="font-size:2rem;"></i>
                                    </div>
                                    <h6 class="h-title fw-bold text-dark mb-2">{{ $f['title'] }}</h6>
                                    <p class="h-p text-muted small mb-0">{{ $f['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="cta-section mt-4 text-center">
                        <a href="https://wa.me/6285713296692?text={{ urlencode('Halo SynergyTeam, saya tertarik dengan layanan tugas akhir. Bisa dijelaskan lebih lanjut?') }}"
                           target="_blank" class="btn btn-success btn-md px-4 py-3 fw-semibold">
                            📞 Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right Illustration --}}
            <div class="col-lg-6 col-md-12 text-center">
                <img src="{{ asset('assets/img/ilustrasi-why.webp') }}" 
                     alt="Mengapa Synergy Team" class="img-fluid">
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
