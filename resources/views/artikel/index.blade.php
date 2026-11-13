@extends('layouts.landing')

@section('title', $seo['title'] ?? 'Artikel & Wawasan Teknologi - Synergy Team')

@section('seo')
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    <meta name="keywords" content="{{ $seo['keywords'] }}">
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:image" content="{{ asset('assets/img/logosynergyteam.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['title'] }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{ asset('assets/img/logosynergyteam.png') }}">
    <link rel="canonical" href="{{ url()->current() }}">
@endsection

@push('styles')
<style>
    .article-hero {
        background: linear-gradient(135deg, #126ebb 0%, #0c54b7 100%);
        color: white;
        padding: 60px 0 50px 0;
    }
    .news-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0,0,0,0.06);
    }
    .news-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 28px rgba(12, 84, 183, 0.12) !important;
    }
    .news-card:hover .news-img-wrapper img {
        transform: scale(1.06);
    }
    .title-hover:hover {
        color: #0c54b7 !important;
    }
    .cat-pill {
        transition: all 0.2s ease;
        text-decoration: none;
        border-radius: 30px;
        padding: 8px 18px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    .cat-pill.active {
        background: #0c54b7;
        color: white !important;
        box-shadow: 0 4px 10px rgba(12, 84, 183, 0.25);
    }
    .cat-pill:not(.active) {
        background: #ffffff;
        color: #495057;
        border: 1px solid #dee2e6;
    }
    .cat-pill:not(.active):hover {
        background: #e9ecef;
        color: #0c54b7;
    }
</style>
@endpush

@section('content')
{{-- HERO BANNER --}}
<div class="article-hero position-relative overflow-hidden mb-5">
    <div class="container text-center position-relative" style="z-index: 2;">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="d-inline-block mb-3">
            <ol class="breadcrumb bg-transparent p-0 mb-0" style="opacity: 0.9;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Artikel</li>
            </ol>
        </nav>

        <h1 class="display-5 fw-bold mb-3">Artikel dan Berita</h1>
        <p class="lead mx-auto mb-4" style="max-width: 680px; opacity: 0.95;">
            Kumpulan panduan, tips pembuatan website, jasa coding, integrasi payment gateway, dan wawasan teknologi terbaru dari tim ahli Synergy Team.
        </p>

        {{-- Search Bar --}}
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <form action="{{ route('artikel.index') }}" method="GET">
                    @if(request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    <div class="input-group input-group-lg shadow-sm" style="border-radius: 50px; overflow: hidden; background: white;">
                        <input type="text" name="q" class="form-control border-0 px-4" placeholder="Cari topik atau artikel..." value="{{ request('q') }}" style="box-shadow: none;">
                        <button class="btn btn-light bg-white text-primary px-4 fw-semibold border-start" type="submit" style="color: #0c54b7 !important;">
                            <i class="bi bi-search me-1"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Background Ornaments --}}
    <div class="position-absolute" style="top: -60px; right: -60px; width: 220px; height: 220px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
    <div class="position-absolute" style="bottom: -50px; left: -50px; width: 180px; height: 180px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
</div>

<div class="container pb-5">
    {{-- CATEGORY FILTER PILLS --}}
    <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap mb-5">
        <a href="{{ route('artikel.index', request()->only('q')) }}"
           class="cat-pill {{ !request('kategori') ? 'active' : '' }}">
            Semua Topik
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('artikel.index', array_merge(request()->only('q'), ['kategori' => $cat])) }}"
           class="cat-pill {{ request('kategori') == $cat ? 'active' : '' }}">
            {{ $cat }}
        </a>
        @endforeach
    </div>

    {{-- RESULTS INFO IF FILTERED --}}
    @if(request('q') || request('kategori'))
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            Menampilkan hasil untuk:
            @if(request('kategori'))
                <span class="text-primary fw-bold me-2">{{ request('kategori') }}</span>
            @endif
            @if(request('q'))
                <span class="text-muted">Kata kunci: "<strong>{{ request('q') }}</strong>"</span>
            @endif
        </div>
        <a href="{{ route('artikel.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-x-circle me-1"></i> Reset Filter
        </a>
    </div>
    @endif

    {{-- ARTICLES GRID (Konsep Inkalum Latest News) --}}
    <div class="row g-4 mb-5">
        @forelse($articles as $item)
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->iteration % 3) * 100 }}">
            <article class="news-card h-100 position-relative overflow-hidden rounded-4 shadow-sm bg-white d-flex flex-column">
                <div class="news-img-wrapper position-relative overflow-hidden" style="height: 220px;">
                    <img src="{{ $item->thumbnail_url }}"
                         class="w-100 h-100 img-fluid"
                         style="object-fit: cover; transition: transform 0.5s ease;"
                         alt="{{ $item->title }}"
                         loading="lazy">
                    <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2 text-white"
                          style="background: rgba(0, 0, 0, 0.45); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 20px; font-size: 0.75rem; font-weight: 500;">
                        {{ $item->category }}
                    </span>
                </div>
                <div class="news-content p-4 d-flex flex-column flex-grow-1">
                    <div class="news-meta mb-2 d-flex align-items-center gap-2 text-muted small">
                        <span class="text-primary fw-semibold">
                            <i class="bi bi-calendar-event me-1"></i>{{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : $item->created_at->translatedFormat('d M Y') }}
                        </span>
                        <span>•</span>
                        <span><i class="bi bi-clock me-1"></i>{{ $item->reading_time }} mnt baca</span>
                    </div>
                    <h3 class="h5 fw-bold mb-2">
                        <a href="{{ route('artikel.show', $item->slug) }}" class="text-decoration-none text-dark stretched-link title-hover">
                            {{ $item->title }}
                        </a>
                    </h3>
                    <p class="text-muted small mt-2 mb-4 flex-grow-1" style="line-height: 1.6;">
                        {{ Str::limit($item->excerpt, 120) }}
                    </p>
                    <div class="pt-3 border-top mt-auto d-flex justify-content-between align-items-center">
                        <span class="text-primary fw-semibold small d-inline-flex align-items-center">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                        </span>
                        <small class="text-muted"><i class="bi bi-eye me-1"></i>{{ number_format($item->views) }}</small>
                    </div>
                </div>
            </article>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="p-5 bg-light rounded-4">
                <i class="bi bi-search fa-3x text-muted mb-3 d-block" style="font-size: 3rem;"></i>
                <h4 class="fw-bold text-dark">Tidak Ada Artikel Ditemukan</h4>
                <p class="text-muted mb-3">Maaf, kami tidak menemukan artikel yang cocok dengan pencarian atau kategori yang Anda pilih.</p>
                <a href="{{ route('artikel.index') }}" class="btn btn-primary rounded-pill px-4">
                    Lihat Seluruh Artikel
                </a>
            </div>
        </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
</div>
@endsection

