@extends('layouts.landing')

@section('title', $product->name)

@section('content')
<div class="product-detail-page" style="margin-top: 80px;">
    <div class="container pb-5">
        <div class="row">
            {{-- Gambar Produk --}}
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="card-img-top"
                        style="height: 400px; object-fit: cover;">
                    @if($product->thumbnail)
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/'.$product->thumbnail) }}" class="rounded shadow-sm"
                            style="width: 150px; height: 80px; object-fit: cover;">
                    </div>
                    @endif
                </div>
            </div>

            {{-- Detail Produk --}}
            <div class="col-lg-6">
                <div class="product-info">
                    <h1 class="h3 fw-bold mb-3">{{ $product->name }}</h1>
                    <p class="text-muted">{{ $product->description }}</p>


                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="mb-3">
                                <span class="badge bg-primary">{{ $product->subCategory->name ?? 'Tanpa Kategori' }}</span>
                            </div>
                            <div class="h2 fw-bold text-primary mb-3">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-3">
                                <i class="bi bi-clock me-2 text-warning"></i>Estimasi pengerjaan: 7-14 hari kerja
                            </p>
                            <p class="text-muted mb-3">
                                <i class="bi bi-lightning-charge me-2 text-warning"></i>Mudah dipakai dengan cepat
                            </p>
                            <p class="text-muted mb-3">
                                <i class="bi bi-briefcase me-2 text-warning"></i>Bisa untuk project tugas atau portofolio
                            </p>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        @auth
                        <a href="#" class="btn btn-primary flex-fill py-3" id="btnBuyNow" data-product-id="{{ $product->id }}">
                            <i class="bi bi-lightning me-2"></i>Beli Sekarang
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary flex-fill py-3">
                            <i class="bi bi-lightning me-2"></i>Beli Sekarang
                        </a>
                        @endauth

                        <a href="https://wa.me/6285713296692?text={{ urlencode('Halo admin, saya tertarik dengan '.$product->name) }}"
                            target="_blank" class="btn btn-success flex-fill py-3">
                            <i class="bi bi-whatsapp me-2"></i>Hubungi Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <ul class="nav nav-tabs mb-3" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active custom-tab" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc"
                            type="button" role="tab">Deskripsi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link custom-tab" id="spec-tab" data-bs-toggle="tab" data-bs-target="#spec"
                            type="button" role="tab">Fitur & Menu</button>
                    </li>
                </ul>

                <div class="tab-content" id="productTabContent">
                    <!-- Deskripsi -->
                    <div class="tab-pane fade show active" id="desc" role="tabpanel">
                        <div class="card border-0">
                            <div class="card-body">
                                <p class="lead">{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Fitur & Menu -->
                    <div class="tab-pane fade" id="spec" role="tabpanel">
                        <div class="card border-0">
                            <div class="card-body">
                                @if($product->menus->count())
                                <div class="row">
                                    @foreach($product->menus as $menu)
                                    <div class="col-6 mb-3">
                                        <div class="border rounded p-3 h-100">
                                            <h6 class="fw-bold mb-1">{{ $menu->name }}</h6>
                                            <p class="text-muted mb-0 small">{{ $menu->description }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <p class="text-muted">Belum ada menu atau fitur terkait.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk Terkait --}}
        @if($relatedProducts->count())
        <div class="row mt-5">
            <div class="col">
                <h4 class="fw-bold mb-4">Produk Terkait</h4>
                <div class="row">
                    @foreach ($relatedProducts as $related)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/'.$related->image) }}" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-bold mb-3">{{ $related->name }}</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-success fw-bold">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                                    <div class="mb-3">Review <i class="bi bi-star-fill text-warning"></i><small class="ms-1">5</small></div>
                                </div>
                                <a href="{{ route('produk.detail.view', $related->id) }}" class="btn btn-primary mt-auto">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
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
</div>

<style>
    .custom-tab {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0c54b7 !important;
        border: none;
        transition: all 0.3s ease;
    }

    .custom-tab:hover {
        color: #0842a0 !important;
    }

    .custom-tab.active {
        color: #0c54b7 !important;
        border-bottom: 3px solid #0c54b7;
        background-color: transparent;
    }

    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
    }
</style>


<script>
    document.getElementById('btnBuyNow').addEventListener('click', async function(e) {
        e.preventDefault();
        const productId = this.dataset.productId;
        const btn = this;

        const { value: method } = await Swal.fire({
            title: 'Pilih Metode Pembayaran',
            input: 'select',
            inputOptions: {
                'QRIS': 'QRIS (Otomatis)',
                'BCAVA': 'BCA Virtual Account',
                'BNIVA': 'BNI Virtual Account',
                'BRIVA': 'BRI Virtual Account',
                'MANDIRIVA': 'Mandiri Virtual Account',
            },
            inputPlaceholder: 'Pilih metode...',
            showCancelButton: true,
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value) {
                        resolve();
                    } else {
                        resolve('Anda harus memilih metode pembayaran!');
                    }
                });
            }
        });

        if (!method) return;

        Swal.fire({
            title: 'Memproses...',
            text: 'Sedang membuat pesanan Anda',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            const response = await fetch('{{ route("tripay.create") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    method
                })
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Pesanan dibuat. Anda akan diarahkan ke halaman pembayaran.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = data.payment_url;
                });
            } else {
                Swal.fire({
                    title: 'Gagal!',
                    text: data.message || 'Gagal membuat pembayaran Tripay.',
                    icon: 'error'
                });
            }
        } catch (error) {
            Swal.fire({
                title: 'Error!',
                text: 'Terjadi kesalahan sistem. Silakan coba lagi nanti.',
                icon: 'error'
            });
            console.error("TRIPAY ERROR:", error);
        }
    });
</script>


@endsection