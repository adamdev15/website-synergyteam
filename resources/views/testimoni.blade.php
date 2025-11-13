@extends('layouts.landing')

@section('title', 'Testimoni Pelanggan - Synergy Team')

@section('content')
{{-- ================= TESTIMONI SECTION ================= --}}
<section class="py-5 position-relative overflow-hidden">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold" style="color:#126ebb;">
            Suara dari Pengguna <span style="color:#0c54b7;">Synergyteam.id</span>
        </h2>

        @if($testimonis->count())
            <div class="row g-4">
                @foreach($testimonis as $t)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border p-4"">
                            <div class="mb-3">
                                <i class="bi bi-quote" style="color:#126ebb;font-size:2rem;"></i>
                                <p class="small text-muted mb-0">
                                    “{{ \Illuminate\Support\Str::limit($t->testimoni, 200) }}”
                                </p>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                @if($t->profil)
                                    <img src="{{ asset('uploads/profil/'.$t->profil) }}"
                                         onerror="this.src='https://via.placeholder.com/100x100/6c757d/ffffff?text=User';"
                                         class="rounded-circle me-3" width="60" height="60"
                                         style="object-fit:cover;">
                                @else
                                    <img src="https://via.placeholder.com/100x100/6c757d/ffffff?text=User"
                                         class="rounded-circle me-3" width="60" height="60">
                                @endif
                                <div>
                                    <h6 class="mb-0">{{ $t->name ?? 'Pelanggan Synergy Team' }}</h6>
                                    <small class="text-muted">{{ $t->email ?? '' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 text-muted">
                <div style="font-size:2rem;">💬</div>
                <h4 class="mt-3">Belum ada testimoni</h4>
                <p>Testimoni pelanggan akan ditampilkan di sini setelah dikirim.</p>
            </div>
        @endif
    </div>
</section>

{{-- ================= CTA SECTION ================= --}}
<section class="text-white position-relative overflow-hidden shadow-sm my-5 mx-auto"
         style="background:linear-gradient(135deg,#126ebb 0%,#0c54b7 100%);
         border-radius:20px;padding:60px 30px;max-width:1200px;">
    <div class="container text-center position-relative">
        <h2 class="fw-bold mb-4">Saatnya Ide Anda menjadi Solusi Profesional di Era Digital</h2>
        <p class="lead mb-5">
            Bangun ide Anda menjadi solusi digital yang profesional dan berinovasi.
            Synergyteam.id siap membantu Anda membangun website, sistem, atau aplikasi sesuai kebutuhan Anda —
            baik untuk bisnis, institusi, maupun pendidikan.
        </p>
        <div class="d-flex justify-content-center gap-4 flex-wrap">
            <a href="{{ url('/pembuatan-website') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold shadow"
               style="border-radius:50px;">🚀 Bangun Website Sekarang</a>
            <a href="{{ url('/kontak-kami') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold"
               style="border-radius:50px;">📞 Konsultasi Gratis</a>
        </div>
    </div>

    {{-- Dekorasi --}}
    <div class="position-absolute top-0 end-0"
         style="width:200px;height:200px;background:rgba(255,255,255,0.1);
         border-radius:50%;animation:float 15s ease-in-out infinite reverse;"></div>
</section>
@endsection
