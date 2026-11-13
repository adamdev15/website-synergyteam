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
    {{-- AOS (Animate On Scroll) CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <style>
        html {
            scroll-behavior: smooth;
        }

        body { font-family: 'DM Sans', sans-serif; overflow-x: hidden; }
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
        {{ $slot ?? '' }}
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- AOS (Animate On Scroll) JS --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 60
            });
        });
    </script>
    @stack('scripts')
</body>

</html>