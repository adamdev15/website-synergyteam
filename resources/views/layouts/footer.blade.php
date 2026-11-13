{{-- FOOTER SYNERGY TEAM --}}
<footer class="footer-section position-relative bg-white pt-5 border-top">
    <div class="container">
        <div class="row mb-2">
            {{-- Logo & Deskripsi --}}
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

            {{-- Layanan Kami --}}
            <div class="col-md-3 col-6 mb-4">
                <h5 class="fw-bold mb-4 text-synergy">Layanan Kami</h5>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2"><a href="{{ url('/jasa-coding') }}" class="item text-muted text-decoration-none">Jasa Coding Anda</a></li>
                    <li class="mb-2"><a href="{{ url('/pembuatan-website') }}" class="item text-muted text-decoration-none">Pembuatan Website</a></li>
                    <li class="mb-2"><a href="{{ url('/api-integration') }}" class="item text-muted text-decoration-none">API Integration App</a></li>
                    <li class="mb-2"><a href="{{ url('/hosting-domain') }}" class="item text-muted text-decoration-none">Hosting &amp; Domain</a></li>
                    <li class="mb-2"><a href="{{ url('/tugas-akhir') }}" class="item text-muted text-decoration-none">Layanan Sistem Tugas Akhir</a></li>
                    <li class="mb-2"><a href="{{ route('artikel.index') }}" class="item text-muted text-decoration-none">Artikel &amp; Edukasi</a></li>
                </ul>
            </div>

            {{-- Produk Kami --}}
            <div class="col-md-5 col-6 mb-4">
                <h5 class="fw-bold mb-4 text-synergy">Produk Kami</h5>
                <ul class="text-muted ps-3 mb-0">
                    @php
                    $allProducts = isset($subcategories) ? $subcategories->flatMap(fn($sub) => $sub->products) : collect();
                    @endphp

                    @forelse($allProducts as $prod)
                    @php
                        // Ambil nama inti produk sebelum tanda '-' jika ada
                        $coreName = str_contains($prod->name, '-') ? explode('-', $prod->name)[0] : $prod->name;
                        // Bersihkan emoji / simbol khusus di awal atau akhir nama
                        $coreName = preg_replace('/[\x{1F000}-\x{1FFFF}\x{2600}-\x{27BF}\x{FE00}-\x{FE0F}]/u', '', $coreName);
                        $coreName = trim($coreName);
                    @endphp
                    <li class="mb-2">
                        <a href="{{ url('/produk/' . $prod->id) }}" class="item text-muted text-decoration-none" title="{{ $prod->name }}">
                            {{ $coreName }}
                        </a>
                    </li>
                    @empty
                    <li><span class="text-muted">Tidak ada produk</span></li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom py-3 mt-1 text-center" style="background: rgba(207,232,252,0.3);">
        <p class="mb-2">© 2025 Synergy Team. Hak Cipta Dilindungi.</p>
        <div>
            <a href="#" class="text-decoration-none me-3" style="color: #0c54b7">Syarat &amp; Ketentuan</a>
            <a href="#" class="text-decoration-none me-3" style="color: #0c54b7">Kebijakan Privasi</a>
            <a href="{{ url('/kontak-kami') }}" class="text-decoration-none" style="color: #0c54b7">Kontak</a>
        </div>
    </div>
</footer>

