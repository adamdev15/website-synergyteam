@extends('layouts.admin')

@section('title', 'Edit Artikel')
@section('sub-title', 'Perbarui Konten Artikel & Pengaturan SEO')

@push('styles')
<style>
    .ck-editor__editable_inline {
        min-height: 380px;
    }
    .serp-preview {
        background: #ffffff;
        border: 1px solid #dfe1e5;
        border-radius: 8px;
        padding: 16px;
        font-family: Arial, sans-serif;
    }
    .serp-url {
        font-size: 13px;
        color: #202124;
        line-height: 1.3;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .serp-title {
        font-size: 20px;
        color: #1a0dab;
        line-height: 1.3;
        font-weight: 400;
        cursor: pointer;
        margin-top: 4px;
        margin-bottom: 4px;
    }
    .serp-title:hover {
        text-decoration: underline;
    }
    .serp-desc {
        font-size: 14px;
        color: #4d5156;
        line-height: 1.58;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6 class="fw-bold mb-2"><i class="fas fa-exclamation-triangle me-1"></i> Mohon periksa kembali form berikut:</h6>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.artikel.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- Main Column --}}
            <div class="col-lg-8">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0 text-primary"><i class="fas fa-edit me-2"></i>Edit Konten Artikel</h6>
                        <a href="{{ route('artikel.show', $article->slug) }}" target="_blank" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-external-link-alt me-1"></i> Preview di Website
                        </a>
                    </div>
                    <div class="card-body">
                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Judul Artikel <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $article->title) }}" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Slug URL --}}
                        <div class="mb-3">
                            <label for="slug" class="form-label fw-semibold">URL Slug (SEO Friendly)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted small">{{ url('/artikel') }}/</span>
                                <input type="text" class="form-control font-monospace @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $article->slug) }}">
                            </div>
                            @error('slug') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        {{-- Ringkasan / Excerpt --}}
                        <div class="mb-3">
                            <label for="excerpt" class="form-label fw-semibold">Ringkasan / Excerpt Singkat</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $article->excerpt) }}</textarea>
                            @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Konten Utama CKEditor 5 --}}
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold">Isi Artikel Lengkap <span class="text-danger">*</span></label>
                            <textarea id="editor" name="content">{{ old('content', $article->content) }}</textarea>
                            @error('content') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                {{-- SEO Meta Card --}}
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0 text-success"><i class="fas fa-search me-2"></i>Pengaturan Optimasi SEO</h6>
                        <span class="badge bg-success-soft text-success"><i class="fas fa-magic me-1"></i>Google Friendly</span>
                    </div>
                    <div class="card-body">
                        {{-- Meta Title --}}
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="meta_title" class="form-label fw-semibold">Meta Title (SEO Title)</label>
                                <small id="metaTitleCount" class="text-muted">0 / 60 karakter</small>
                            </div>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $article->meta_title) }}">
                        </div>

                        {{-- Meta Description --}}
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="meta_description" class="form-label fw-semibold">Meta Description</label>
                                <small id="metaDescCount" class="text-muted">0 / 160 karakter</small>
                            </div>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $article->meta_description) }}</textarea>
                        </div>

                        {{-- Meta Keywords --}}
                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label fw-semibold">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $article->meta_keywords) }}">
                        </div>

                        {{-- Canonical URL --}}
                        <div class="mb-3">
                            <label for="canonical_url" class="form-label fw-semibold">Canonical URL</label>
                            <input type="url" class="form-control" id="canonical_url" name="canonical_url" value="{{ old('canonical_url', $article->canonical_url) }}">
                        </div>

                        {{-- SERP Simulator Preview --}}
                        <div class="mt-4">
                            <label class="form-label fw-semibold text-dark"><i class="fab fa-google text-danger me-1"></i> Pratinjau Tampilan Google (SERP Simulator)</label>
                            <div class="serp-preview">
                                <div class="serp-url">
                                    <img src="{{ asset('assets/img/logosynergyteam.png') }}" width="16" height="16" alt="favicon" class="rounded-circle">
                                    <span>synergyteam.id › artikel › <span id="serpSlug">{{ $article->slug }}</span></span>
                                </div>
                                <div class="serp-title" id="serpTitle">{{ $article->effective_meta_title }}</div>
                                <div class="serp-desc" id="serpDesc">{{ $article->effective_meta_description }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar Column --}}
            <div class="col-lg-4">
                {{-- Publish Box --}}
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="fw-bold mb-0 text-dark"><i class="fas fa-paper-plane me-2"></i>Publikasi &amp; Status</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_published" name="is_published" value="1" {{ old('is_published', $article->is_published ? '1' : '0') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_published">Status: Terbitkan Artikel</label>
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label fw-semibold">Tanggal Terbit</label>
                            <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="reading_time" class="form-label fw-semibold">Estimasi Waktu Baca (Menit)</label>
                            <input type="number" min="1" class="form-control" id="reading_time" name="reading_time" value="{{ old('reading_time', $article->reading_time) }}">
                        </div>

                        <div class="mb-3">
                            <small class="text-muted"><i class="far fa-eye me-1"></i>Total Dibaca: <strong>{{ number_format($article->views) }} kali</strong></small>
                        </div>

                        <hr>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2 fw-semibold">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Kategori & Penulis --}}
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="fw-bold mb-0 text-dark"><i class="fas fa-tags me-2"></i>Kategori &amp; Penulis</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="category" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                            <input type="text" list="categoryList" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category', $article->category) }}" required>
                            <datalist id="categoryList">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                            </datalist>
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label fw-semibold">Nama Penulis</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $article->author) }}">
                        </div>
                    </div>
                </div>

                {{-- Featured Image / Thumbnail --}}
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="fw-bold mb-0 text-dark"><i class="fas fa-image me-2"></i>Gambar Sampul (Thumbnail)</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewThumbnail(this)">
                            <small class="text-muted">Pilih gambar baru jika ingin mengganti thumbnail saat ini.</small>
                            @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="text-center p-2 border rounded bg-light">
                            <img id="thumbnailPreview" src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
{{-- CKEditor 5 Classic Build --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    let editorInstance;
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', 'link', '|',
                'bulletedList', 'numberedList', 'blockQuote', '|',
                'insertTable', 'undo', 'redo'
            ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            }
        })
        .then(editor => {
            editorInstance = editor;
            editor.model.document.on('change:data', () => {
                updateSerpPreview();
            });
        })
        .catch(error => {
            console.error('CKEditor Error:', error);
        });

    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const metaTitleInput = document.getElementById('meta_title');
    const metaDescInput = document.getElementById('meta_description');
    const excerptInput = document.getElementById('excerpt');

    const serpTitle = document.getElementById('serpTitle');
    const serpSlug = document.getElementById('serpSlug');
    const serpDesc = document.getElementById('serpDesc');

    const metaTitleCount = document.getElementById('metaTitleCount');
    const metaDescCount = document.getElementById('metaDescCount');

    titleInput.addEventListener('input', updateSerpPreview);
    slugInput.addEventListener('input', updateSerpPreview);
    metaTitleInput.addEventListener('input', updateSerpPreview);
    metaDescInput.addEventListener('input', updateSerpPreview);
    excerptInput.addEventListener('input', updateSerpPreview);

    function updateSerpPreview() {
        const titleVal = metaTitleInput.value.trim() || (titleInput.value.trim() ? titleInput.value.trim() + ' - Synergy Team' : 'Judul Artikel');
        serpTitle.textContent = titleVal;
        metaTitleCount.textContent = metaTitleInput.value.length + ' / 60 karakter';
        metaTitleCount.className = metaTitleInput.value.length > 60 ? 'text-danger fw-bold' : 'text-muted';

        const slugVal = slugInput.value.trim() || 'url-artikel';
        serpSlug.textContent = slugVal;

        const descVal = metaDescInput.value.trim() || excerptInput.value.trim() || 'Deskripsi cuplikan artikel yang menarik akan muncul di Google...';
        serpDesc.textContent = descVal;
        metaDescCount.textContent = metaDescInput.value.length + ' / 160 karakter';
        metaDescCount.className = metaDescInput.value.length > 160 ? 'text-danger fw-bold' : 'text-muted';
    }

    function previewThumbnail(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('thumbnailPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    updateSerpPreview();
</script>
@endpush
