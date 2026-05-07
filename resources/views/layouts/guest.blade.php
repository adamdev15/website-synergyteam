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
        body { font-family: 'DM Sans', sans-serif; }
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

        .show-on-hover:hover > .dropdown-menu {
          display: block;
        }

        .dropdown-submenu {
          position: relative;
        }

        .dropdown-submenu > .submenu {
          display: none;
          position: absolute;
          top: 0;
          left: 100%;
          background-color: #fff;
          min-width: 200px;
          border: 1px solid #ddd;
          z-index: 1000;
        }

        .subcategory-item:hover {
          color: #0c54b7 !important;
          background-color: #f8f9fa;
        }
        .text-primary {
            color: #0c54b7;
        }
        
    </style>

    @stack('styles')
</head>

<body>

    <main>
        @yield('content')
    </main>

    <footer class="footer-section position-relative bg-white pt-5 border-top">
        <!-- <img src="{{ asset('footerbackground.png') }}" alt="Decoration" class="footer-bg-image"> -->
        <div class="container">
            <div class="row mb-2">
                {{-- Logo & Sosial --}}
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
                <div class="col-md-2 col-6 mb-4">
                    <h5 class="fw-bold mb-4 text-synergy">Layanan Kami</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="{{ url('/login') }}" class="text-muted text-decoration-none">Jasa Coding Anda</a></li>
                        <li><a href="{{ url('/login') }}" class="text-muted text-decoration-none">Pembuatan Website</a></li>
                        <li><a href="{{ url('/login') }}" class="text-muted text-decoration-none">API Integration App</a></li>
                        <li><a href="{{ url('/login') }}" class="text-muted text-decoration-none">Hosting & Domain</a></li>
                        <li><a href="{{ url('/login') }}" class="text-muted text-decoration-none">Layanan Sistem Tugas Akhir</a></li>
                    </ul>
                </div>

                {{-- Produk --}}
                <div class="col-md-2 col-6 mb-4">
                    <h5 class="fw-bold mb-4 text-synergy">Produk Kami</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="{{ url('/login') }}" class="text-muted text-decoration-none">Website Portofolio</a></li>
                        <li><a href="{{ url('/login') }}" class="text-muted text-decoration-none">Sistem Penjualan</a></li>
                        <li><a href="{{ url('/login') }}" class="text-muted text-decoration-none">Aplikasi Custom</a></li>
                    </ul>
                </div>

                {{-- Newsletter Form --}}
                <div class="col-md-4 mb-4">
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
                <a href="{{ url('/login') }}" class="text-decoration-none me-3" style="color: #0c54b7">Syarat & Ketentuan</a>
                <a href="{{ url('/login') }}" class="text-decoration-none me-3" style="color: #0c54b7">Kebijakan Privasi</a>
                <a href="{{ url('/login') }}" class="text-decoration-none" style="color: #0c54b7">Kontak</a>
            </div>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>