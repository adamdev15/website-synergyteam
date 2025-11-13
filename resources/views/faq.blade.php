@extends('layouts.landing')

@section('title', 'FAQ - Synergy Team')

@section('content')
<div class="faq" style="min-height:100vh; padding:60px 20px;">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color:#0c54b7;">Pertanyaan yang Sering Diajukan</h1>
            <p class="text-muted">Temukan jawaban atas pertanyaan umum tentang layanan kami.</p>
        </div>

        <div class="accordion accordion-flush" id="faqAccordion">
            @foreach ($faqs as $index => $faq)
                <div class="accordion-item border-0 shadow-sm mb-3 rounded">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button collapsed fw-semibold"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $index }}"
                                aria-expanded="false"
                                aria-controls="collapse{{ $index }}">
                            {{ $faq['question'] }}
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}"
                         class="accordion-collapse collapse"
                         aria-labelledby="heading{{ $index }}"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- CTA SECTION --}}
<section class="container-fluid text-white position-relative overflow-hidden shadow-sm my-5"
         style="background:linear-gradient(135deg,#126ebb 0%,#0c54b7 100%);
         border-radius:20px;padding:60px 30px;">
    <div class="text-center position-relative">
        <h2 class="fw-bold mb-4">Saatnya Ide Anda menjadi Solusi Profesional di Era Digital</h2>
        <p class="lead mb-5">
            Bangun ide Anda menjadi solusi digital yang profesional dan berinovasi.
            <strong>SynergyTeam.id</strong> siap membantu Anda membangun website, sistem, atau aplikasi
            sesuai kebutuhan Anda — baik untuk bisnis, institusi, maupun pendidikan.
        </p>
        <div class="d-flex justify-content-center gap-4 flex-wrap">
            <a href="{{ url('/pembuatan-website') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold shadow"
               style="border-radius:50px;">🚀 Bangun Website Sekarang</a>
            <a href="https://wa.me/6285713296692"
               class="btn btn-outline-light btn-lg px-5 py-3 fw-bold"
               style="border-radius:50px;">📞 Konsultasi Gratis</a>
        </div>
    </div>

    <div class="position-absolute top-0 end-0"
         style="width:200px;height:200px;background:rgba(255,255,255,0.1);
         border-radius:50%;animation:float 15s ease-in-out infinite reverse;"></div>
</section>
@endsection
