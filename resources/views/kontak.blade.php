@extends('layouts.landing')

@section('title', 'Kontak Kami - Synergy Team')

@section('content')
<div>
    <div class="container py-5">
        <div class="row">
            {{-- LEFT - INFORMASI KONTAK --}}
            <div class="col-md-6 pe-md-4 mb-4 mb-md-0">
                <div class="mb-4">
                    <div class="d-flex align-items-start mb-2">
                        <div class="me-3">
                            <i class="bi bi-geo-alt-fill fs-4 text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2 text-primary">Alamat</h5>
                            <p class="text-muted mb-0">
                                JL Raya Pringsurat - Temanggung, Kelurahan Kebumen, Kec. Pringsurat
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex align-items-start mb-2">
                        <div class="me-3">
                            <i class="bi bi-envelope-fill fs-4 text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2 text-primary">Email</h5>
                            <p class="text-muted mb-0">myschid@gmail.com</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="d-flex align-items-start mb-2">
                        <div class="me-3">
                            <i class="bi bi-telephone-fill fs-4 text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2 text-primary">Telepon</h5>
                            <div class="text-muted">
                                <p class="mb-1">085740000146 (CS-Klien Berbayar)</p>
                                <p class="mb-1">081325430232 (Aftersales)</p>
                                <p class="mb-1">081228237219 (Sales Website)</p>
                                <p class="mb-0">082136278218 (Sales Aplikasi)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT - FORM KONTAK --}}
            <div class="col-md-6 ps-md-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="nama" class="form-control border-0 bg-light py-3 rounded-3"
                                   placeholder="Nama" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" name="email" class="form-control border-0 bg-light py-3 rounded-3"
                                   placeholder="Email" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="tel" name="telepon" class="form-control border-0 bg-light py-3 rounded-3"
                                   placeholder="Telepon">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" name="judul" class="form-control border-0 bg-light py-3 rounded-3"
                                   placeholder="Judul">
                        </div>
                    </div>

                    <div class="mb-4">
                        <textarea name="pesan" rows="6" class="form-control border-0 bg-light rounded-3"
                                  placeholder="Isi Pesan" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg px-4 py-3 fw-semibold rounded-3">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- CTA SECTION --}}
    <section class="container text-white text-center position-relative overflow-hidden shadow-sm my-5"
             style="background:linear-gradient(135deg,#126ebb 0%,#0c54b7 100%);
             border-radius:20px;padding:60px 30px;">
        <div class="position-relative">
            <h2 class="fw-bold mb-4">Saatnya Ide Anda menjadi Solusi Profesional di Era Digital</h2>
            <p class="lead mb-5">
                Bangun ide Anda menjadi solusi digital yang profesional dan berinovasi.
                <strong>Synergyteam.id</strong> siap membantu Anda membangun website, sistem, atau aplikasi sesuai kebutuhan Anda — baik untuk bisnis, institusi, maupun pendidikan.
            </p>
            <div class="d-flex justify-content-center gap-4 flex-wrap">
                <a href="{{ url('/pembuatan-website') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold shadow rounded-pill">
                    🚀 Bangun Website Sekarang
                </a>
                <a href="https://wa.me/6285713296692" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold rounded-pill">
                    📞 Konsultasi Gratis
                </a>
            </div>
        </div>

        <div class="position-absolute top-0 end-0"
             style="width:200px;height:200px;background:rgba(255,255,255,0.1);
             border-radius:50%;animation:float 15s ease-in-out infinite reverse;"></div>
    </section>
</div>
@endsection
