@extends('layouts.landing')

@section('title', 'Promo Spesial - Synergy Team')

@section('content')
<section class="container-fluid hero-section position-relative overflow-hidden py-5">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-lg-7 col-md-12 px-1 px-lg-5 text-white">
        <h1 class="display-4 fw-bold mb-4">Promo Menarik Untuk Anda!</h1>
        <p class="lead mb-4">
          Dapatkan berbagai penawaran promo spesial dari SynergyTeam.id.
          Jangan lewatkan kesempatan terbatas ini untuk menghemat lebih banyak
          dan mendapatkan layanan terbaik dengan harga istimewa!
        </p>
        <div class="hero-buttons">
          <a href="#cek-promo" class="btn btn-warning btn-lg me-3 px-4 py-3 fw-semibold text-white">Cek Promo 🏷️</a>
          <a href="https://wa.me/6285713296692?text={{ urlencode('Halo SynergyTeam.id, saya tertarik dengan promo Anda!') }}"
             target="_blank" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold">Hubungi Admin →</a>
        </div>
      </div>
      <div class="col-lg-5 col-md-12 text-center">
        <img src="{{ asset('assets/img/bg-section.png') }}" alt="Promo Ilustrasi" class="img-fluid rounded-3" style="width:450px;">
      </div>
    </div>
  </div>
</section>

{{-- =================== PROMO SECTION =================== --}}
<div class="container py-5" id="cek-promo">
  <div class="text-center mb-5">
    <h2 class="fw-bold mb-2" style="color:#0c54b7;">Promo Terbaru SynergyTeam.id</h2>
    <p class="text-muted">Manfaatkan promo spesial kami sebelum berakhir!</p>
  </div>

  @if ($promos->isEmpty())
      <div class="text-center py-5">
          <div class="display-1 mb-3 text-muted">📭</div>
          <h4 class="text-muted mb-3">Belum Ada Promo Tersedia</h4>
          <p class="text-muted">
              Promo menarik akan segera hadir. Pantau terus halaman ini untuk mendapatkan penawaran terbaik!
          </p>
          <a href="https://wa.me/6285713296692?text={{ urlencode('Halo SynergyTeam.id, saya ingin tahu promo terbaru.') }}"
             class="btn btn-primary px-4 py-3 fw-semibold mt-3" target="_blank">Hubungi Admin 📞</a>
      </div>
  @else
      <div class="row">
          @foreach ($promos as $promo)
              <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                  <div class="card h-100 shadow-sm border-0 hover-card" style="transition:transform 0.2s;">
                      <div class="position-relative">
                          <img src="{{ $promo->image ? asset($promo->image) : asset('assets/img/default-promo.jpg') }}"
                               alt="{{ $promo->name }}" class="card-img-top" style="height:200px;object-fit:cover;">
                          <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 rounded-bottom-start"
                               style="font-size:0.8rem;font-weight:bold;">PROMO</div>
                      </div>
                      <div class="card-body d-flex flex-column">
                          <h5 class="fw-bold text-dark mb-3">{{ $promo->name }}</h5>
                          <p class="text-muted small mb-3">
                              📅 {{ $promo->start_date->format('d M Y') }} - {{ $promo->end_date->format('d M Y') }}
                          </p>
                          <p class="fw-semibold text-primary mb-3">💰 Diskon Rp{{ number_format($promo->discount_amount, 0, ',', '.') }}</p>
                          <a href="https://wa.me/6285713296692?text={{ urlencode('Halo, saya tertarik dengan promo '.$promo->name) }}"
                             class="btn btn-warning w-100 fw-bold text-white" style="border-radius:0.5rem;">Dapatkan Sekarang</a>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>
  @endif
</div>

{{-- =================== CTA SECTION =================== --}}
<section class="container text-white position-relative overflow-hidden shadow-sm my-5"
         style="background:linear-gradient(135deg,#126ebb 0%,#0c54b7 100%);
         border-radius:20px;padding:60px 30px;">
  <div class="text-center">
    <h2 class="fw-bold mb-4">Saatnya Ide Anda menjadi Solusi Profesional di Era Digital</h2>
    <p class="lead mb-5">
      Bangun ide Anda menjadi solusi digital yang profesional dan inovatif.
      <strong>SynergyTeam.id</strong> siap membantu Anda membangun website, sistem, atau aplikasi sesuai kebutuhan —
      untuk bisnis, institusi, maupun pendidikan.
    </p>
    <div class="d-flex justify-content-center gap-4 flex-wrap">
      <a href="{{ url('/pembuatan-website') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold shadow" style="border-radius:50px;">🚀 Bangun Website Sekarang</a>
      <a href="{{ url('/kontak-kami') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold" style="border-radius:50px;">📞 Konsultasi Gratis</a>
    </div>
  </div>
</section>

<style>
  .hover-card:hover { transform: translateY(-5px); }
</style>
@endsection
