@extends('layouts.landing')

@section('title', $article->effective_meta_title)

@section('seo')
    <title>{{ $article->effective_meta_title }}</title>
    <meta name="description" content="{{ $article->effective_meta_description }}">
    @if($article->meta_keywords)
        <meta name="keywords" content="{{ $article->meta_keywords }}">
    @endif
    <meta name="author" content="{{ $article->author }}">
    <link rel="canonical" href="{{ $article->canonical_url ?: url()->current() }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $article->effective_meta_title }}">
    <meta property="og:description" content="{{ $article->effective_meta_description }}">
    <meta property="og:image" content="{{ $article->effective_og_image }}">
    <meta property="og:site_name" content="Synergy Team">
    <meta property="article:published_time" content="{{ $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String() }}">
    <meta property="article:author" content="{{ $article->author }}">
    <meta property="article:section" content="{{ $article->category }}">

    {{-- Twitter Cards --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $article->effective_meta_title }}">
    <meta name="twitter:description" content="{{ $article->effective_meta_description }}">
    <meta name="twitter:image" content="{{ $article->effective_og_image }}">

    {{-- Schema.org JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
        "{{ '@context' }}": "https://schema.org",
        "{{ '@type' }}": "Article",
        "headline": "{{ addslashes($article->title) }}",
        "image": [
            "{{ $article->effective_og_image }}"
        ],
        "datePublished": "{{ $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String() }}",
        "dateModified": "{{ $article->updated_at->toIso8601String() }}",
        "author": [{
            "{{ '@type' }}": "Person",
            "name": "{{ addslashes($article->author) }}"
        }],
        "publisher": {
            "{{ '@type' }}": "Organization",
            "name": "Synergy Team",
            "logo": {
                "{{ '@type' }}": "ImageObject",
                "url": "{{ asset('assets/img/logosynergyteam.png') }}"
            }
        },
        "description": "{{ addslashes($article->effective_meta_description) }}",
        "mainEntityOfPage": {
            "{{ '@type' }}": "WebPage",
            "{{ '@id' }}": "{{ url()->current() }}"
        }
    }
    </script>
@endsection

@push('styles')
<style>
    /* KONSEP DETAIL ARTIKEL INKALUM */
    .article-container {
        max-width: 1140px;
        margin: 0 auto;
    }
    .article-hero-img-wrapper {
        width: 100%;
        max-height: 480px;
        overflow: hidden;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        background: #f1f3f5;
    }
    .article-hero-img {
        width: 100%;
        height: 100%;
        max-height: 480px;
        object-fit: cover;
        display: block;
    }
    .article-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #1a1e21;
        line-height: 1.35;
        margin-top: 24px;
        margin-bottom: 12px;
    }
    .article-meta {
        font-size: 0.92rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding-bottom: 20px;
        border-bottom: 1px solid #edf0f2;
    }
    .article-body {
        font-size: 1.08rem;
        line-height: 1.9;
        color: #2b3035;
        margin-top: 28px;
    }
    .article-body h2 {
        font-size: 1.6rem;
        font-weight: 700;
        color: #0c54b7;
        margin-top: 36px;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid rgba(12, 84, 183, 0.1);
    }
    .article-body h3 {
        font-size: 1.35rem;
        font-weight: 600;
        color: #126ebb;
        margin-top: 28px;
        margin-bottom: 14px;
    }
    .article-body p {
        margin-bottom: 20px;
    }
    .article-body blockquote {
        background: #f8faff;
        border-left: 4px solid #0c54b7;
        padding: 18px 24px;
        margin: 28px 0;
        border-radius: 0 12px 12px 0;
        font-style: italic;
        color: #334155;
    }
    .article-body ul, .article-body ol {
        margin-bottom: 22px;
        padding-left: 28px;
    }
    .article-body li {
        margin-bottom: 8px;
    }
    .article-body img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 24px 0;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    }

    /* SHARE BUTTONS */
    .share-btn {
        border-radius: 30px;
        padding: 6px 16px;
        font-size: 0.88rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .share-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.12);
    }

    /* SIDEBAR (KONSEP INKALUM) */
    .article-sidebar {
        border-left: 1px solid #edf0f2;
        padding-left: 30px;
    }
    @media (max-width: 991.98px) {
        .article-sidebar {
            border-left: none;
            padding-left: 0;
            margin-top: 48px;
            border-top: 1px solid #edf0f2;
            padding-top: 36px;
        }
        .article-title {
            font-size: 1.7rem;
        }
    }

    /* PROMO / ADS CARD IN SIDEBAR */
    .sidebar-promo-card {
        background: linear-gradient(135deg, #126ebb 0%, #0c54b7 100%);
        border-radius: 16px;
        color: white;
        padding: 26px;
        position: relative;
        overflow: hidden;
        margin-bottom: 35px;
        box-shadow: 0 10px 25px rgba(12, 84, 183, 0.2);
    }
    .sidebar-promo-card h5 {
        font-weight: 700;
        font-size: 1.25rem;
    }

    /* RELATED ARTICLES */
    .related-card {
        display: flex;
        gap: 14px;
        margin-bottom: 20px;
        text-decoration: none;
        color: inherit;
        transition: all 0.25s ease;
    }
    .related-card:hover .related-title {
        color: #0c54b7;
    }
    .related-img-wrapper {
        width: 100px;
        height: 75px;
        flex-shrink: 0;
        border-radius: 10px;
        overflow: hidden;
    }
    .related-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .related-card:hover .related-img {
        transform: scale(1.08);
    }
    .related-title {
        font-size: 0.95rem;
        font-weight: 600;
        line-height: 1.4;
        color: #212529;
        margin-bottom: 4px;
        transition: color 0.2s ease;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="article-container">
        {{-- BREADCRUMB --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}" class="text-decoration-none text-muted">Artikel</a></li>
                <li class="breadcrumb-item"><a href="{{ route('artikel.index', ['kategori' => $article->category]) }}" class="text-decoration-none text-muted">{{ $article->category }}</a></li>
                <li class="breadcrumb-item active text-dark text-truncate" style="max-width: 320px;" aria-current="page">{{ $article->title }}</li>
            </ol>
        </nav>

        {{-- HERO IMAGE (KONSEP INKALUM) --}}
        <div class="article-hero-img-wrapper mb-4">
            <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" class="article-hero-img">
        </div>

        {{-- CATEGORY BADGE --}}
        <div class="mb-2">
            <a href="{{ route('artikel.index', ['kategori' => $article->category]) }}"
               class="badge px-3 py-2 text-white text-decoration-none shadow-sm"
               style="background: linear-gradient(135deg, #126ebb, #0c54b7); border-radius: 20px; font-size: 0.8rem;">
                {{ $article->category }}
            </a>
        </div>

        {{-- ARTICLE TITLE (KONSEP INKALUM) --}}
        <h1 class="article-title">{{ $article->title }}</h1>

        {{-- ARTICLE META (KONSEP INKALUM: TANGGAL • VIEWS) --}}
        <div class="article-meta">
            <span><i class="bi bi-calendar-event me-1 text-primary"></i>{{ $article->published_at ? $article->published_at->translatedFormat('d F Y') : $article->created_at->translatedFormat('d F Y') }}</span>
            <span>•</span>
            <span><i class="bi bi-eye me-1 text-primary"></i>{{ number_format($article->views) }} views</span>
            <span>•</span>
            <span><i class="bi bi-clock me-1 text-primary"></i>{{ $article->reading_time }} menit baca</span>
            <span>•</span>
            <span><i class="bi bi-person-check me-1 text-primary"></i>Oleh: <strong>{{ $article->author }}</strong></span>
        </div>

        <div class="row mt-4">
            {{-- MAIN ARTICLE CONTENT (COL-LG-8) --}}
            <div class="col-lg-8">
                <article class="article-body">
                    {!! $article->content !!}
                </article>

                {{-- TAGS JIKA ADA --}}
                @if($article->meta_keywords)
                <div class="mt-4 pt-3 border-top">
                    <small class="text-muted fw-semibold me-2"><i class="bi bi-tags me-1"></i>Tags:</small>
                    @foreach(explode(',', $article->meta_keywords) as $tag)
                        @if(trim($tag))
                            <span class="badge bg-light text-dark border me-1 mb-1">{{ trim($tag) }}</span>
                        @endif
                    @endforeach
                </div>
                @endif

                {{-- SHARE BUTTONS (KONSEP INKALUM) --}}
                <div class="mt-4 pt-4 border-top">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="fw-bold me-2 text-dark"><i class="bi bi-share me-1"></i>Bagikan:</span>

                        {{-- WhatsApp --}}
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . url()->current()) }}"
                           target="_blank" rel="noopener noreferrer"
                           class="share-btn btn btn-outline-success">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>

                        {{-- Facebook --}}
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                           target="_blank" rel="noopener noreferrer"
                           class="share-btn btn btn-outline-primary">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>

                        {{-- Twitter / X --}}
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}"
                           target="_blank" rel="noopener noreferrer"
                           class="share-btn btn btn-outline-dark">
                            <i class="bi bi-twitter-x"></i> Twitter
                        </a>

                        {{-- LinkedIn --}}
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                           target="_blank" rel="noopener noreferrer"
                           class="share-btn btn btn-outline-info">
                            <i class="bi bi-linkedin"></i> LinkedIn
                        </a>

                        {{-- Copy Link --}}
                        <button type="button" class="share-btn btn btn-outline-secondary" onclick="copyCurrentUrl()">
                            <i class="bi bi-link-45deg"></i> Salin Link
                        </button>
                    </div>
                </div>

                {{-- AUTHOR CARD --}}
                <div class="card border-0 bg-light rounded-4 p-4 mt-5">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('assets/img/logosynergyteam.png') }}" alt="Synergy Team" width="60" height="60" class="rounded-circle shadow-sm bg-white p-1">
                        <div>
                            <h6 class="fw-bold mb-1 text-primary">{{ $article->author }}</h6>
                            <p class="text-muted small mb-0">Tim pengembang software house dan konsultan teknologi digital Synergy Team yang berdedikasi membantu transformasi digital bisnis dan institusi Anda.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SIDEBAR (COL-LG-4) --}}
            <div class="col-lg-4 article-sidebar">
                {{-- CTA PROMO CARD (SESUAI KONSEP SIDEBAR-ADS INKALUM NAMUN KHUSUS SYNERGYTEAM) --}}
                <div class="sidebar-promo-card">
                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-semibold mb-3">Solusi Digital</span>
                    <h5 class="mb-3">Wujudkan Website &amp; Sistem Aplikasi Impian Anda!</h5>
                    <p class="small mb-4" style="opacity: 0.95;">
                        Konsultasikan kebutuhan pembuatan website, sistem tugas akhir, atau integrasi API bersama tim Synergy Team.
                    </p>
                    <a href="https://wa.me/6285713296692?text={{ urlencode('Halo Synergy Team, saya tertarik berkonsultasi mengenai pembuatan website/aplikasi setelah membaca artikel: ' . $article->title) }}"
                       target="_blank"
                       class="btn btn-light fw-bold text-primary w-100 rounded-pill py-2 shadow-sm">
                        <i class="bi bi-whatsapp text-success me-1"></i> Konsultasi Gratis Sekarang
                    </a>
                </div>

                {{-- BERITA / ARTIKEL TERKAIT (KONSEP INKALUM) --}}
                <div class="mb-4">
                    <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: #0c54b7;">
                        <i class="bi bi-newspaper me-1"></i> Artikel Terkait
                    </h5>

                    @forelse($relatedArticles as $rel)
                    <a href="{{ route('artikel.show', $rel->slug) }}" class="related-card">
                        <div class="related-img-wrapper">
                            <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}" class="related-img">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <div class="related-title">{{ Str::limit($rel->title, 55) }}</div>
                            <small class="text-muted">
                                <i class="bi bi-calendar-event me-1"></i>{{ $rel->published_at ? $rel->published_at->format('d M Y') : $rel->created_at->format('d M Y') }}
                            </small>
                        </div>
                    </a>
                    @empty
                    <p class="text-muted small">Belum ada artikel terkait lainnya.</p>
                    @endforelse
                </div>

                {{-- KATEGORI POPULER --}}
                @if(isset($categories) && count($categories))
                <div class="p-4 bg-light rounded-4">
                    <h6 class="fw-bold mb-3 text-dark"><i class="bi bi-bookmark me-1 text-primary"></i>Kategori Populer</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($categories as $cat)
                        <a href="{{ route('artikel.index', ['kategori' => $cat]) }}" class="badge bg-white text-dark border text-decoration-none px-3 py-2 rounded-pill">
                            {{ $cat }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function copyCurrentUrl() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Tautan Disalin!',
                text: 'Link artikel berhasil disalin ke clipboard.',
                timer: 2000,
                showConfirmButton: false
            });
        }).catch(err => {
            console.error('Gagal menyalin:', err);
        });
    }
</script>
@endpush
