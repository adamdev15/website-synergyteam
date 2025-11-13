@extends('layouts.landing')

@section('title', 'Home - Synergy Team')

@section('content')
    {{-- HERO SECTION --}}
    <section class="hero-section position-relative overflow-hidden">
        <div class="container-fluid py-5">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12 px-1 px-lg-5">
                    <div class="hero-content text-white">
                        <h1 class="display-4 fw-bold mb-4 hero-title">
                            Solusi Terbaik untuk Website Impian Anda
                        </h1>
                        <p class="lead mb-4 hero-subtitle">
                            Synergy Team adalah mitra terpercaya dalam mengembangkan solusi digital untuk kebutuhan teknologi Anda.
                            Kami menyediakan layanan profesional untuk membantu Anda membangun dan mengoptimalkan proyek digital
                            Anda dengan berbagai layanan inovatif.
                        </p>
                        <div class="hero-buttons">
                            <a href="{{ url('/pembuatan-website') }}" class="btn btn-warning btn-lg me-3 px-4 py-3 fw-semibold text-white">
                                Buat Website →
                            </a>
                            <a href="#layanan-kami" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold">
                                Layanan Kami →
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Right Illustration --}}
                <div class="col-lg-5 col-md-12 d-flex justify-content-center align-items-center">
                    <div class="hero-illustration position-relative">
                        <img src="{{ asset('assets/img/ilustrasi.png') }}" alt="Ilustrasi Synergy Team"
                             class="img-fluid rounded dashboard-mockup" style="border-radius: 10px;">

                        {{-- Stats Cards --}}
                        <div class="stats-card position-absolute bg-white rounded shadow p-3 d-none d-md-block"
                             style="top:80px; left:-60px; width:180px;">
                            <div class="text-center">
                                <div class="h4 text-primary fw-bold mb-1">50.000+</div>
                                <div class="small text-muted">Pengguna Synergy Team</div>
                            </div>
                        </div>

                        <div class="stats-card position-absolute bg-white rounded shadow p-3 d-none d-md-block"
                             style="bottom:50px; left:-40px; width:180px;">
                            <div class="text-center">
                                <div class="h5 text-primary fw-bold mb-1">15 program</div>
                                <div class="small text-muted">Telah diakses berbagai klien</div>
                            </div>
                        </div>

                        <div class="stats-card position-absolute bg-white rounded shadow p-3 d-none d-md-block"
                             style="top:200px; right:-40px; width:160px;">
                            <div class="text-center">
                                <div class="h5 text-primary fw-bold mb-1">10 Tahun</div>
                                <div class="small text-muted">Melayani Klien seluruh Indonesia</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Background Pattern --}}
        <div class="position-absolute" style="top:-50px; right:-50px; width:200px; height:200px;
            background:rgba(255,255,255,0.1); border-radius:50%; animation:float 10s ease-in-out infinite;"></div>
        <div class="position-absolute" style="bottom:-30px; left:-30px; width:150px; height:150px;
            background:rgba(255,255,255,0.1); border-radius:50%; animation:float 12s ease-in-out infinite reverse;"></div>
    </section>


    {{-- WHY SECTION --}}
    <section class="why-section bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 pe-lg-5 mb-4 mb-lg-0">
                    <div class="why-content">
                        <h2 class="display-6 fw-bold text-dark mb-4 text-center">
                            Mengapa Harus Memilih <span class="text-primary">Synergy Team</span> Sebagai Solusi Digital Anda?
                        </h2>

                        <div class="row g-3">
                            @php
                                $features = [
                                    ['icon'=>'bi-box-seam text-primary', 'title'=>'One Project Solution', 'desc'=>'Semua kebutuhan solusi Anda terpenuhi di satu tempat'],
                                    ['icon'=>'bi-person-badge text-success', 'title'=>'Tim Profesional', 'desc'=>'Dikerjakan oleh developer berpengalaman di bidangnya'],
                                    ['icon'=>'bi-chat-dots text-warning', 'title'=>'Konsultasi Gratis', 'desc'=>'Kami siap membantu Anda mewujudkan ide menjadi solusi digital'],
                                    ['icon'=>'bi-cash-coin text-danger', 'title'=>'Harga Kompetitif', 'desc'=>'Kualitas premium dengan harga tetap bersahabat'],
                                ];
                            @endphp

                            @foreach($features as $f)
                                <div class="col-6 col-sm-6">
                                    <div class="card h-100 border-0 shadow-sm p-3">
                                        <div class="icon-circle mb-3 d-flex align-items-center justify-content-center">
                                            <i class="bi {{ $f['icon'] }}"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-2">{{ $f['title'] }}</h6>
                                        <p class="text-muted small mb-0">{{ $f['desc'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="cta-section mt-4 text-center">
                            <a href="{{ url('/kontak-kami') }}" class="btn btn-success btn-md px-4 py-3 fw-semibold cta-button">
                                📞 Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Right Illustration --}}
                <div class="col-lg-6 col-md-12 text-center">
                    <img src="{{ asset('assets/img/ilustrasi-why.webp') }}" alt="Mengapa Synergy Team" class="img-fluid">
                </div>
            </div>
        </div>
    </section>


    {{-- LAYANAN SECTION --}}
    <section id="layanan-kami" class="py-5" style="background-color: #f8f9ff;">
        <div class="container text-center mb-5">
            <h2 class="display-5 fw-bold mb-4 text-primary">Layanan Kami</h2>
            <div class="underline mx-auto mb-4" style="width:80px; height:3px; background:linear-gradient(90deg,#126ebb,#0c54b7);"></div>
            <p class="lead text-muted">
                Synergy Team menyediakan layanan profesional untuk membangun dan mengoptimalkan proyek digital Anda.
            </p>
        </div>

        <div class="container">
            <div class="row">
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6 col-6 col-sm-6 mb-4">
                        <a href="{{ url($service['path']) }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm service-card text-center p-4">
                                <div class="service-icon mb-3 mx-auto d-flex align-items-center justify-content-center"
                                     style="width:80px; height:80px; border-radius:50%; overflow:hidden;">
                                    <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}"
                                         style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                                </div>
                                <h5 class="h-title fw-bold mb-3 text-dark">{{ $service['title'] }}</h5>
                                <p class="h-p text-muted">{{ $service['description'] }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SECTION BANK SAMPAH --}}
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                {{-- Left Content --}}
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-5 fw-bold mb-4" style="color:#126ebb;">Aplikasi Eco Market</h2>
                    <div class="underline mb-4"
                        style="width:80px;height:3px;background:linear-gradient(90deg,#126ebb,#0c54b7);"></div>

                    <p class="fs-5 text-muted mb-4 lh-lg">
                        Eco Market adalah aplikasi berbasis web yang dirancang untuk pengelolaan bank sampah sekaligus menjadi
                        platform market bagi UMKM lokal. Pengguna dapat menabung dengan sampah serta mendukung pemberdayaan
                        UMKM setempat. Aplikasi ini dikembangkan dengan fitur-fitur modern.
                    </p>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-2" style="color:#126ebb;">Fitur Unggulan:</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><span class="text-success me-2">✓</span>Manajemen Bank Sampah</li>
                            <li class="mb-2"><span class="text-success me-2">✓</span>Marketplace UMKM</li>
                            <li class="mb-2"><span class="text-success me-2">✓</span>Fitur Tabungan Daur Ulang</li>
                            <li class="mb-2"><span class="text-success me-2">✓</span>Berbasis PWA & Notifikasi Real-time</li>
                        </ul>
                    </div>

                    <a href="https://ecomarket.adamm.web.id/" target="_blank"
                    class="btn btn-primary btn-lg">
                        Demo Aplikasi
                    </a>
                </div>

                {{-- Right Image --}}
                <div class="col-lg-6">
                    <div class="lms-image-placeholder d-flex align-items-center justify-content-center rounded-3"
                        style="height:500px;animation:float 8s ease-in-out infinite;">
                        <img src="{{ asset('assets/img/portfolio/project-1.jpg') }}" alt="Eco Market"
                            style="max-height:100%;max-width:100%;object-fit:contain;border-radius:1rem;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--  SECTION FAQ  --}}
    <section class="faq-section bg-white py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="fw-semibold text-primary">F.A.Q</h6>
                <h4 class="fw-bold text-dark">Pertanyaan Seputar Layanan Synergyteam.id</h4>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="accordion" id="faqLeft">
                        @php
                            $faqLeft = [
                                ['q' => 'Apakah Synergyteam.id Melayani Pembuatan Website?', 'a' => 'Ya, kami menyediakan layanan pembuatan website yang modern, responsif, dan mudah dikelola.'],
                                ['q' => 'Apakah Bisa Mengintegrasikan API Pihak Ketiga?', 'a' => 'Tentu, kami dapat membantu integrasi dengan berbagai API seperti sistem akademik, pembayaran, atau lainnya.'],
                                ['q' => 'Apa Saja yang Didapatkan dari Jasa Coding Anda?', 'a' => 'Anda akan mendapatkan layanan pengembangan aplikasi custom sesuai kebutuhan, baik untuk web maupun mobile.'],
                                ['q' => 'Apakah Synergyteam.id Menyediakan Hosting dan Domain?', 'a' => 'Ya, kami menyediakan paket lengkap termasuk domain dan hosting yang cepat dan aman.'],
                                ['q' => 'Apakah Bisa Kustomisasi Desain Website?', 'a' => 'Ya, tampilan website bisa disesuaikan agar sesuai dengan identitas visual dan kebutuhan sekolah.'],
                                ['q' => 'Berapa Lama Proses Pembuatan Website?', 'a' => 'Waktu pengerjaan bergantung pada kompleksitas proyek, rata-rata antara 1–3 minggu.'],
                            ];
                        @endphp

                        @foreach($faqLeft as $i => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqL{{ $i }}">
                                    <button class="accordion-button {{ $i !== 0 ? 'collapsed' : '' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseL{{ $i }}"
                                            aria-expanded="{{ $i === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapseL{{ $i }}">
                                        {{ $faq['q'] }}
                                    </button>
                                </h2>
                                <div id="collapseL{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}"
                                    aria-labelledby="faqL{{ $i }}" data-bs-parent="#faqLeft">
                                    <div class="accordion-body text-muted">{{ $faq['a'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="accordion" id="faqRight">
                        @php
                            $faqRight = [
                                ['q' => 'Apakah Ada Layanan Pengembangan Sistem Sekolah?', 'a' => 'Kami melayani pengembangan sistem akademik, keuangan, dan administrasi sekolah berbasis web atau PWA.'],
                                ['q' => 'Apakah Layanan Termasuk Pemeliharaan (Maintenance)?', 'a' => 'Ya, kami menyediakan layanan maintenance untuk memastikan sistem berjalan lancar dan aman.'],
                                ['q' => 'Apakah Bisa Mengembangkan Sistem Tugas Akhir Mahasiswa?', 'a' => 'Ya, kami menyediakan layanan sistem pengelolaan tugas akhir untuk kampus atau fakultas.'],
                                ['q' => 'Apakah Ada Garansi untuk Layanan yang Diberikan?', 'a' => 'Kami memberikan garansi support dan perbaikan dalam periode tertentu setelah proyek selesai.'],
                                ['q' => 'Bagaimana Proses Pembayaran Layanan di Synergyteam.id?', 'a' => 'Pembayaran dapat dilakukan bertahap sesuai milestone proyek, atau langsung sesuai paket layanan.'],
                                ['q' => 'Bagaimana Cara Memulai Proyek dengan Synergyteam.id?', 'a' => 'Anda cukup menghubungi kami melalui kontak yang tersedia, dan kami akan bantu analisa kebutuhan Anda.'],
                            ];
                        @endphp

                        @foreach($faqRight as $i => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqR{{ $i }}">
                                    <button class="accordion-button {{ $i !== 0 ? 'collapsed' : '' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseR{{ $i }}"
                                            aria-expanded="{{ $i === 0 ? 'true' : 'false' }}"
                                            aria-controls="collapseR{{ $i }}">
                                        {{ $faq['q'] }}
                                    </button>
                                </h2>
                                <div id="collapseR{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}"
                                    aria-labelledby="faqR{{ $i }}" data-bs-parent="#faqRight">
                                    <div class="accordion-body text-muted">{{ $faq['a'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimoni --}}
    <section class="py-5 text-white position-relative overflow-hidden"
        style="background: linear-gradient(135deg, #126ebb 0%, #0c54b7 100%)">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">Apa Kata <span style="color: #ffd700">Pelanggan</span>?</h2>
                    <div id="carouselTestimoni" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($testimonials as $key => $t)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <blockquote class="lead fst-italic">"{{ $t->testimoni }}"</blockquote>
                                <div class="d-flex align-items-center gap-3 mt-3">
                                    @if ($t->image_public || $t->profil)
                                        <img src="{{ $t->image_public ?? asset('uploads/profil/'.$t->profil) }}"
                                            alt="{{ $t->name }}" class="rounded-circle" width="50" height="50"
                                            style="object-fit: cover;">
                                    @endif
                                    <div>
                                        <strong>{{ $t->name }}</strong>
                                        <div class="small text-light">{{ $t->email }}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 text-center">
                    <img src="{{ asset('assets/img/testimoni.png') }}" alt="Ilustrasi Testimoni" class="img-fluid"
                        style="max-width: 70%; height: auto;">
                </div>
            </div>
        </div>
    </section>

    {{--  SECTION AKSI (CALL TO ACTION)  --}}
    <section class="container text-white position-relative overflow-hidden shadow-sm my-5"
            style="background:linear-gradient(135deg,#126ebb 0%,#0c54b7 100%);border-radius:20px;padding:60px 30px;">
        <div class="cta text-center position-relative">
            <h2 class=" fw-bold mb-4">Saatnya Ide Anda menjadi Solusi Profesional di Era Digital</h2>
            <p class="lead mb-5">
                Bangun ide Anda menjadi solusi digital yang profesional dan inovatif.  
                Synergyteam.id siap membantu Anda membangun website, sistem, atau aplikasi sesuai kebutuhan Anda —
                baik untuk bisnis, institusi, maupun pendidikan.
            </p>
            <div class="d-flex justify-content-center gap-4 flex-wrap">
                <a href="{{ url('/pembuatan-website') }}" class="button btn btn-light btn-lg px-5 py-3 fw-bold shadow" style="border-radius:50px;">
                    🚀 Bangun Website Sekarang
                </a>
                <a href="{{ url('/kontak-kami') }}" class="button btn btn-outline-light btn-lg px-5 py-3 fw-bold" style="border-radius:50px;">
                    📞 Konsultasi Gratis
                </a>
            </div>
        </div>

        <div class="position-absolute top-0 end-0"
            style="width:200px;height:200px;background:rgba(255,255,255,0.1);border-radius:50%;
            animation:float 15s ease-in-out infinite reverse;"></div>
    </section>
@endsection
