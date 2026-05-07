<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Synergy Team')</title>
    <link rel="icon" href="{{ asset('assets/img/logosynergyteam.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .custom-navbar {
            background-color: #ffffff;
        }

        .custom-navbar .nav-link,
        .custom-navbar .navbar-brand,
        .custom-navbar .dropdown-toggle {
            color: #333 !important;
        }

        .btn-masuk {
            background: #ff9801;
            color: white;
            border: none;
            padding: 10px 16px;
            transition: background 0.3s ease;
        }

        .btn-masuk:hover {
            background: #e56e00;
            color: white;
        }

        .custom-navbar .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        .kategori-dropdown .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #0c54b7 !important;
        }

        .show-on-hover:hover>.dropdown-menu {
            display: block;
        }

        .list-unstyled .item:hover {
            color: #0c54b7 !important;
        }

        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.submenu {
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            background-color: #fff;
            min-width: 200px;
            border: 1px solid #ddd;
            z-index: 1000;
        }

        .dropdown-submenu>.submenu {
            display: none;
        }

        .subcategory-item:hover {
            color: #0c54b7 !important;
            background-color: #f8f9fa;
        }

        @media (max-width: 576px) {
            .h-title {
                font-size: 0.8rem;
            }

            .h-p {
                font-size: 0.7rem;
            }

            .h-order {
                font-size: 0.5rem;
                width: 3rem;
            }

            .cta h2 {
                font-size: 1.2rem;
            }

            .cta p {
                font-size: 1rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg shadow-md sticky-top custom-navbar">
        <div class="container px-3">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logosynergyteam.png') }}" alt="Synergy Team" width="45" class="me-2">
                <img src="{{ asset('assets/img/synergyteam.png') }}" alt="Logo Synergy" style="max-width: 80px; height: auto;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main-navbar">
                <ul class="navbar-nav ms-auto gap-3 align-items-center">
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/') }}">Home</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Profil</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                            <li><a class="dropdown-item" href="{{ url('/testimoni') }}">Testimoni</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown kategori-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Layanan Kami</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ url('/jasa-coding') }}">
                                    <img src="{{ asset('assets/img/icon/jasacoding.png') }}" width="25" height="25" class="rounded">
                                    Jasa Coding Anda
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" href="{{ url('/pembuatan-website') }}">
                                    <img src="{{ asset('assets/img/icon/website.jpg') }}" width="25" height="25" class="rounded">
                                    Pembuatan Website
                                </a>
                            </li>

                            @forelse($subcategories as $sub)
                            <li class="dropdown-submenu position-relative">
                                <a class="dropdown-item d-flex align-items-center justify-content-between toggle-submenu" href="javascript:void(0)">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($sub->thumbnail)
                                        <img src="{{ asset('storage/' . $sub->thumbnail) }}" width="25" height="25" class="rounded" onerror="this.src='{{ asset('assets/img/icon/website.jpg') }}'">
                                        @endif
                                        {{ $sub->name }}
                                    </div>
                                    @if($sub->products && count($sub->products))
                                    <span class="text-muted">&gt;</span>
                                    @endif
                                </a>

                                @if($sub->products && count($sub->products))
                                <ul class="dropdown-menu submenu position-absolute start-100 top-0" style="display: none;">
                                    @foreach($sub->products as $prod)
                                    <li><a class="dropdown-item text-muted" href="{{ url('/produk/' . $prod->id) }}">{{ $prod->name }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @empty
                            <li><span class="dropdown-item disabled">Tidak ada layanan</span></li>
                            @endforelse

                            <li>
                                <a class="dropdown-item" href="{{ url('/api-integration') }}">
                                    <img src="{{ asset('assets/img/icon/api.png') }}" width="25" height="25" class="rounded">
                                    API Integration App
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/hosting-domain') }}">
                                    <img src="{{ asset('assets/img/icon/hostingdomain.png') }}" width="25" height="25" class="rounded">
                                    Hosting & Domain
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/tugas-akhir') }}">
                                    <img src="{{ asset('assets/img/icon/ta.png') }}" width="25" height="25" class="rounded">
                                    Layanan Tugas Akhir
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/promo') }}">Promo</a></li>

                    {{-- Pembayaran --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Pembayaran</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/pemesanan') }}">Cara Pemesanan</a></li>
                            <li><a class="dropdown-item" href="{{ url('/pembayaran') }}">Cara Pembayaran</a></li>
                        </ul>
                    </li>

                    {{-- Bantuan --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Bantuan</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/faq') }}">FAQ</a></li>
                            <li><a class="dropdown-item" href="{{ url('/kontak-kami') }}">Kontak Kami</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex justify-content-center align-items-center ms-3">
                    @auth
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/img/illustrations/profiles/profile-2.png') }}" alt="Profile" width="35" height="35" class="rounded-circle">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end mt-2 shadow" aria-labelledby="profileDropdown">
                            <li>
                                <h6 class="dropdown-header mb-0"><i class="bi bi-person-badge me-2"></i> {{ Auth::user()->name }}</h6>
                            </li>

                            <li>
                                <a href="{{ route('riwayat-transaksi') }}" class="dropdown-item text-muted">
                                    <i class="bi bi-receipt me-2"></i> Riwayat Transaksi
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item text-muted">
                                    <i class="bi bi-person-circle me-2"></i> Profil Saya
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    @else
                    <a href="{{ route('login') }}" class="btn btn-masuk">Buat Sekarang</a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer-section position-relative bg-white pt-5 border-top">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-center mb-3 gap-3">
                        <img width="60" src="{{ asset('assets/img/logosynergyteam.png') }}" alt="Logo Synergy Team">
                        <img width="100" src="{{ asset('assets/img/synergyteam.png') }}" alt="Logo Synergy Alt">
                    </div>
                    <p class="text-muted">Synergy Team adalah mitra terpercaya dalam mengembangkan solusi digital untuk kebutuhan teknologi Anda.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-primary fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-primary fs-5"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-primary fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-primary fs-5"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                {{-- Layanan --}}
                <div class="col-md-3 col-6 mb-4">
                    <h5 class="fw-bold mb-4 text-synergy">Layanan Kami</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="{{ url('/jasa-coding') }}" class="item text-muted text-decoration-none">Jasa Coding Anda</a></li>
                        <li><a href="{{ url('/pembuatan-website') }}" class="item text-muted text-decoration-none">Pembuatan Website</a></li>
                        <li><a href="{{ url('/api-integration') }}" class="item text-muted text-decoration-none">API Integration App</a></li>
                        <li><a href="{{ url('/hosting-domain') }}" class="item text-muted text-decoration-none">Hosting & Domain</a></li>
                        <li><a href="{{ url('/tugas-akhir') }}" class="item text-muted text-decoration-none">Layanan Sistem Tugas Akhir</a></li>
                    </ul>
                </div>

                {{-- Produk --}}
                <div class="col-md-2 col-6 mb-4">
                    <h5 class="fw-bold mb-4 text-synergy">Produk Kami</h5>
                    <ul class="list-unstyled text-muted">
                        @php
                        $allProducts = $subcategories->flatMap(fn($sub) => $sub->products);
                        @endphp

                        @forelse($allProducts as $prod)
                        <li>
                            <a href="{{ url('/produk/' . $prod->id) }}" class="item text-muted text-decoration-none">
                                {{ $prod->name }}
                            </a>
                        </li>
                        @empty
                        <li><span class="text-muted">Tidak ada produk</span></li>
                        @endforelse
                    </ul>
                </div>

                {{-- Newsletter Form --}}
                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold mb-4 text-synergy">Berlangganan Newsletter</h5>
                    <p class="text-muted small">Dapatkan update terbaru tentang promo, layanan, dan proyek kami.</p>

                    @if(session('success'))
                    <div class="alert alert-success py-2 small">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger py-2 small">
                        {{ $errors->first('email') }}
                    </div>
                    @endif

                    <form action="{{ route('newsletter.store') }}" method="POST" class="d-flex mt-3">
                        @csrf
                        <input type="email" name="email" class="form-control me-2" placeholder="Masukkan email Anda" required>
                        <button type="submit" class="btn btn-primary px-3">Kirim</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="footer-bottom py-3 mt-1 text-center" style="background: rgba(207,232,252,0.3);">
            <p class="mb-2">© 2025 Synergy Team. Hak Cipta Dilindungi.</p>
            <div>
                <a href="#" class="text-decoration-none me-3" style="color: #0c54b7">Syarat & Ketentuan</a>
                <a href="#" class="text-decoration-none me-3" style="color: #0c54b7">Kebijakan Privasi</a>
                <a href="#" class="text-decoration-none" style="color: #0c54b7">Kontak</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const submenuToggles = document.querySelectorAll(".toggle-submenu");

            submenuToggles.forEach(toggle => {
                toggle.addEventListener("click", function(e) {
                    e.preventDefault();
                    document.querySelectorAll(".dropdown-submenu .submenu").forEach(menu => {
                        if (menu !== this.nextElementSibling) {
                            menu.style.display = "none";
                        }
                    });
                    const submenu = this.nextElementSibling;
                    if (submenu) {
                        submenu.style.display = submenu.style.display === "block" ? "none" : "block";
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>

</html>