@extends('layouts.landing')

@section('title', $product->name)

@section('content')
<div class="produk-page">

    {{-- Hero Section --}}
    <section class="py-5 hero-produk position-relative overflow-hidden" style="background-color: #0c54b7">
        <div class="container">
            <div class="row align-items-center min-vh-50">
                <div class="col-lg-6 text-white">
                    <h1 class="display-4 fw-bold mb-4">{{ $product->name }}</h1>
                    <p class="lead mb-4" style="color: #ffffffda;">{{ $product->description }}</p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ url('/produk-detail/' . $product->id) }}"
                            class="btn btn-masuk text-white" style="width: 220px">Beli Sekarang →</a>
                        <a href="https://wa.me/6285713296692?text={{ urlencode('Halo admin, saya mau konsultasi mengenai produk '.$product->name) }}"
                            target="_blank" rel="noopener noreferrer" class="btn btn-outline-light px-4" style="border-color: #fff;">
                            Konsultasi Admin 📞
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded"
                        style="max-height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>
                <div class="position-absolute" style="top:-50px; right:-50px; width:200px; height:200px;
            background:rgba(255,255,255,0.1); border-radius:50%; animation:float 10s ease-in-out infinite;"></div>
        <div class="position-absolute" style="bottom:-30px; left:-30px; width:150px; height:150px;
            background:rgba(255,255,255,0.1); border-radius:50%; animation:float 12s ease-in-out infinite reverse;"></div>
    </section>

    {{-- Keunggulan --}}
    <section class="py-5 keunggulan-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Mengapa Harus Memilih <span class="text-primary">Produk Kami?</span></h2>
                    <div class="row g-3">
                        @php
                            $advantages = [
                                ['icon' => '🚀', 'title' => 'Mudah Digunakan', 'desc' => 'Interface yang user-friendly'],
                                ['icon' => '🛠️', 'title' => 'Support 24/7', 'desc' => 'Tim support profesional siap membantu'],
                                ['icon' => '🔒', 'title' => 'Keamanan Terjamin', 'desc' => 'Sistem keamanan berlapis'],
                                ['icon' => '📈', 'title' => 'Scalable', 'desc' => 'Dapat berkembang dengan bisnis Anda']
                            ];
                        @endphp

                        @foreach ($advantages as $adv)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm text-center p-3">
                                <div class="fs-2 mb-2">{{ $adv['icon'] }}</div>
                                <h5 class="fw-bold">{{ $adv['title'] }}</h5>
                                <p class="text-muted">{{ $adv['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}"
                        class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    {{-- Produk Lainnya --}}
    <section class="py-5 produk-lainnya-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Produk <span class="text-primary">Lainnya</span></h2>
                <p class="text-muted lead">Temukan produk lain yang dirancang untuk kebutuhan digital Anda.</p>
            </div>

            <div class="row">
                @foreach ($relatedProducts as $p)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}" class="card-img-top"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold mb-2">{{ $p->name }}</h5>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-success fw-bold">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                                <div class="mb-3">Review <i class="bi bi-star-fill text-warning"></i><small class="ms-1">5</small></div>
                            </div>
                            <a href="{{ route('produk.show.view', $p->id) }}" class="btn btn-primary mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
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

    <style>

        .hero-produk>.container {
            position: relative;
            z-index: 1;
        }

        .min-vh-50 {
            min-height: 50vh;
        }
    </style>
</div>
@endsection
