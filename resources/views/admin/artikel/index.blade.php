@extends('layouts.admin')

@section('title', 'Kelola Artikel & SEO')
@section('sub-title', 'Manajemen Artikel, Publikasi & Optimasi Mesin Pencari (SEO)')

@section('content')
<div class="container-fluid px-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-newspaper me-2"></i>Daftar Artikel Synergy Team</h5>
                <small class="text-muted">Total {{ $articles->count() }} artikel terdaftar</small>
            </div>
            <div>
                <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tulis Artikel Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 90px;">Thumbnail</th>
                            <th>Judul &amp; Kategori</th>
                            <th>Penulis</th>
                            <th>Estimasi</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th style="width: 140px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $i => $item)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>
                                <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="rounded shadow-sm" style="width: 70px; height: 50px; object-fit: cover;">
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $item->title }}</div>
                                <div class="d-flex align-items-center gap-2 mt-1">
                                    <span class="badge bg-primary-soft text-primary">{{ $item->category }}</span>
                                    <small class="text-muted font-monospace"><i class="fas fa-link me-1"></i>{{ $item->slug }}</small>
                                </div>
                            </td>
                            <td><small class="text-muted"><i class="fas fa-user-edit me-1"></i>{{ $item->author }}</small></td>
                            <td><small class="text-muted"><i class="far fa-clock me-1"></i>{{ $item->reading_time }} mnt</small></td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <i class="far fa-eye text-primary me-1"></i>{{ number_format($item->views) }}
                                </span>
                            </td>
                            <td>
                                @if($item->is_published)
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Terbit</span>
                                @else
                                    <span class="badge bg-secondary"><i class="fas fa-pencil-alt me-1"></i>Draft</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                                </small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('artikel.show', $item->slug) }}" target="_blank" class="btn btn-outline-info" title="Lihat di Web">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a href="{{ route('admin.artikel.edit', $item->id) }}" class="btn btn-outline-primary" title="Edit Artikel">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-delete" data-id="{{ $item->id }}" data-title="{{ $item->title }}" title="Hapus Artikel">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.artikel.destroy', $item->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="fas fa-newspaper fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">Belum ada artikel. Klik tombol "Tulis Artikel Baru" untuk mulai membuat konten SEO!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                Swal.fire({
                    title: 'Hapus Artikel?',
                    text: `Apakah Anda yakin ingin menghapus artikel "${title}"? Tindakan ini tidak dapat dibatalkan.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
