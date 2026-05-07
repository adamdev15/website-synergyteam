@extends('layouts.landing')

@section('title', 'Cara Pembayaran - Synergy Team')

@section('content')
<div class="bg-light pemesanan-page">
    <div class="container py-5">
        <div class="row mb-5">
            <div class="col text-center">
                <h1 class="fw-bold" style="color:#0c54b7;">Cara Pembayaran Layanan</h1>
                <p class="text-muted">Ikuti langkah-langkah berikut untuk melakukan pembayaran</p>
            </div>
        </div>

        @foreach ($steps as $index => $step)
            <div class="row align-items-center mb-5 {{ $index % 2 === 1 ? 'flex-row-reverse' : '' }}">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-inline-block text-white px-3 py-2 mb-3 fw-bold"
                                 style="background-color: {{ $step['bgColor'] }}">
                                {{ $step['number'] }} {{ $step['title'] }}
                            </div>
                            <p class="text-muted">{{ $step['description'] }}</p>
                            <div class="mt-3 text-center">
                                <img src="{{ asset('assets/img/' . $step['image']) }}"
                                     alt="{{ $step['title'] }}"
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height:250px;object-fit:cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- CTA Section --}}
<section class="container text-white position-relative overflow-hidden shadow-sm"
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
            <a href="{{ url('/pembuatan-website') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold shadow"
               style="border-radius:50px;">🚀 Bangun Website Sekarang</a>
            <a href="https://wa.me/6285713296692"
               class="btn btn-outline-light btn-lg px-5 py-3 fw-bold"
               style="border-radius:50px;">📞 Konsultasi Gratis</a>
        </div>
    </div>
</section>
@endsection
