<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => '5 Alasan Mengapa Bisnis Anda Wajib Memiliki Website Profesional di 2026',
                'slug' => '5-alasan-mengapa-bisnis-anda-wajib-memiliki-website-profesional-di-2026',
                'category' => 'Pembuatan Website',
                'thumbnail' => 'assets/img/portfolio/project-1.jpg',
                'excerpt' => 'Di era digital yang serba cepat, website bukan lagi sekadar pelengkap, melainkan aset utama bisnis. Simak 5 alasan penting mengapa memiliki website profesional akan melipatgandakan omset dan kepercayaan pelanggan Anda.',
                'content' => '<h2>Membangun Kredibilitas dan Brand Authority</h2>
<p>Di era digital modern saat ini, calon konsumen cenderung mencari informasi melalui Google sebelum memutuskan untuk membeli produk atau menggunakan suatu layanan jasa. Ketika calon konsumen mencari nama bisnis Anda di mesin pencari dan tidak menemukan website resmi, tingkat keraguan mereka akan meningkat drastis.</p>
<p>Website profesional memberikan kesan bahwa bisnis Anda beroperasi secara serius, kredibel, dan berjangka panjang. Dengan menyajikan portofolio, legalitas, serta ulasan pelanggan terverifikasi, Anda sedang membangun <em>brand authority</em> yang solid di mata calon pelanggan.</p>

<h2>Buka 24 Jam Non-Stop Tanpa Batas Geografis</h2>
<p>Toko fisik atau kantor memiliki jam kerja terbatas. Sebaliknya, website Anda bekerja sebagai sales representative terbaik yang bertugas 24 jam sehari, 7 hari seminggu. Calon pelanggan dapat membaca katalog produk, melihat testimoni, bahkan melakukan pemesanan dan pembayaran otomatis di tengah malam.</p>

<blockquote>"Website bukan sekadar brosur digital, melainkan mesin otomasi bisnis yang menjaring prospek potensial setiap detiknya tanpa henti."</blockquote>

<h2>Optimalisasi SEO untuk Mendatangkan Calon Pelanggan Gratis</h2>
<p>Salah satu keunggulan terbesar memiliki website adalah kemampuan untuk menerapkan strategi <strong>Search Engine Optimization (SEO)</strong>. Melalui optimasi kata kunci yang relevan, calon pembeli yang secara aktif membutuhkan solusi Anda akan langsung menemukan website Anda di halaman pertama Google.</p>
<ul>
    <li>Mendapatkan traffic pengunjung organik tanpa harus selalu membayar iklan berbayar (Ads).</li>
    <li>Menargetkan kata kunci spesifik sesuai ceruk pasar (niche) bisnis Anda.</li>
    <li>Memberikan Return on Investment (ROI) jangka panjang yang berkelanjutan.</li>
</ul>

<h2>Integrasi Sistem Pembayaran dan Chat WhatsApp Otomatis</h2>
<p>Di <strong>Synergy Team</strong>, pembuatan website dilengkapi dengan fitur-fitur modern seperti integrasi payment gateway (Tripay, Midtrans, QRIS) dan auto-notification WhatsApp Gateway. Pelanggan tidak perlu repot konfirmasi manual; pesanan langsung terdata rapi di dashboard admin Anda.</p>

<h2>Kendali Penuh Atas Data dan Aset Digital Anda</h2>
<p>Banyak pelaku bisnis hanya mengandalkan media sosial atau marketplace. Namun ingat, algoritma platform pihak ketiga dapat berubah sewaktu-waktu dan akun Anda bisa terkena pembatasan tanpa peringatan. Website adalah aset milik Anda sepenuhnya yang dapat Anda kendalikan 100%.</p>

<p>Siap meningkatkan level bisnis Anda ke era digital? <strong>Synergy Team</strong> siap membantu Anda merancang website responsif, cepat, dan berstandar internasional dengan harga yang terjangkau.</p>',
                'author' => 'Synergy Team',
                'reading_time' => 4,
                'views' => 142,
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'meta_title' => '5 Alasan Bisnis Wajib Memiliki Website Profesional 2026 | Synergy Team',
                'meta_description' => 'Pelajari 5 alasan utama mengapa bisnis Anda wajib memiliki website profesional di tahun 2026. Tingkatkan kredibilitas, jangkauan pasar, dan otomasi penjualan bersama Synergy Team.',
                'meta_keywords' => 'jasa pembuatan website, website profesional, synergy team, web developer tegal, jasa web indonesia, manfaat website bisnis',
                'canonical_url' => null,
                'og_image' => 'assets/img/portfolio/project-1.jpg',
            ],
            [
                'title' => 'Panduan Memilih Jasa Coding dan Software House Terpercaya untuk Skripsi & Bisnis',
                'slug' => 'panduan-memilih-jasa-coding-dan-software-house-terpercaya-untuk-skripsi-dan-bisnis',
                'category' => 'Jasa Coding',
                'thumbnail' => 'assets/img/portfolio/project-2.png',
                'excerpt' => 'Menemukan partner coding yang bertanggung jawab dan kompeten sering kali menjadi tantangan. Berikut panduan lengkap memilih jasa coding dan software house terpercaya agar proyek aplikasi Anda selesai tepat waktu.',
                'content' => '<h2>Tantangan Mencari Partner Coding yang Tepat</h2>
<p>Banyak mahasiswa tingkat akhir maupun pelaku UMKM yang mengeluhkan pengalaman buruk saat menyewa jasa programmer lepas: mulai dari proyek yang ditinggal di tengah jalan (ghosting), kode yang berantakan tanpa dokumentasi, hingga revisi yang tidak dilayani.</p>
<p>Oleh karena itu, memilih <em>software house</em> atau jasa coding yang terbukti profesional adalah langkah krusial untuk menjamin investasi dan waktu Anda tidak terbuang sia-sia.</p>

<h2>1. Periksa Portofolio dan Demo Aplikasi Nyata</h2>
<p>Jangan hanya tergiur oleh janji manis atau tangkapan layar (screenshot). Pastikan penyedia jasa memiliki portofolio sistem yang pernah live atau dapat diakses demonya secara langsung. Sebagai contoh, di Synergy Team kami menyediakan demo live untuk aplikasi seperti <em>Eco Market</em>, <em>Sistem Kasir</em>, dan <em>Sistem Pakar</em> agar Anda dapat mencoba fungsionalitasnya secara langsung.</p>

<h2>2. Pastikan Ada Bimbingan dan Garansi Support</h2>
<p>Bagi mahasiswa yang mengerjakan skripsi atau tugas akhir, kode program saja tidak cukup. Anda membutuhkan pemahaman alur sistem (flowchart, use case diagram, relasi database) agar dapat menjawab pertanyaan dosen penguji dengan percaya diri saat sidang.</p>
<ul>
    <li>Pilihlah penyedia yang menyertakan sesi konsultasi atau bimbingan penjelasan kode.</li>
    <li>Pastikan ada masa garansi perbaikan bug secara gratis setelah serah terima aplikasi.</li>
    <li>Ketersediaan dokumentasi instalasi lengkap untuk memudahkan deployment di laptop Anda.</li>
</ul>

<h2>3. Transparansi Teknologi dan Struktur Biaya</h2>
<p>Software house terpercaya menggunakan teknologi modern yang scalable dan mudah dipelihara (seperti Laravel, Flutter, Vue/React, MySQL/PostgreSQL). Hindari penyedia yang membebankan biaya tersembunyi di kemudian hari. Sistem kontrak atau invoice resmi akan melindungi kedua belah pihak.</p>

<blockquote>"Kualitas kode yang bersih (clean code) dan arsitektur yang rapi adalah investasi terbaik agar aplikasi Anda mudah dikembangkan lebih lanjut di masa mendatang."</blockquote>

<h2>Solusi Jasa Coding Bersama Synergy Team</h2>
<p>Synergy Team hadir dengan komitmen memberikan solusi digital tuntas mulai dari analisis kebutuhan, perancangan database, coding, hingga deployment server. Hubungi tim kami sekarang untuk sesi konsultasi gratis seputar proyek impian Anda.</p>',
                'author' => 'Synergy Team',
                'reading_time' => 5,
                'views' => 98,
                'is_published' => true,
                'published_at' => now()->subDays(6),
                'meta_title' => 'Panduan Memilih Jasa Coding & Software House Terpercaya | Synergy Team',
                'meta_description' => 'Simak tips cerdas memilih jasa coding dan software house terpercaya untuk proyek tugas akhir skripsi maupun aplikasi bisnis Anda agar selesai tepat waktu dan bergaransi.',
                'meta_keywords' => 'jasa coding terpercaya, software house tegal, bimbingan tugas akhir informatika, jasa skripsi ti, pembuatan aplikasi custom, synergy team',
                'canonical_url' => null,
                'og_image' => 'assets/img/portfolio/project-2.png',
            ],
            [
                'title' => 'Strategi Integrasi API Payment Gateway untuk Mengotomatisasi Pembayaran Toko Online',
                'slug' => 'strategi-integrasi-api-payment-gateway-untuk-mengotomatisasi-pembayaran-toko-online',
                'category' => 'API Integration',
                'thumbnail' => 'assets/img/portfolio/project-3.png',
                'excerpt' => 'Tinggalkan metode transfer manual yang rawan penipuan bukti transfer palsu. Pelajari bagaimana integrasi API Payment Gateway seperti Tripay dan Midtrans dapat mengotomatisasi verifikasi pembayaran seketika.',
                'content' => '<h2>Kelemahan Sistem Pembayaran Manual pada Website Toko Online</h2>
<p>Bagi pemilik toko online atau platform digital, memverifikasi bukti transfer manual via mutasi rekening bank adalah pekerjaan yang sangat melelahkan dan rentan kesalahan manusia (human error). Lebih parah lagi, maraknya aksi pemalsuan struk transfer digital dapat merugikan bisnis Anda.</p>

<h2>Apa Itu Payment Gateway dan Bagaimana Cara Kerjanya?</h2>
<p><strong>Payment Gateway</strong> adalah perantara transaksi elektronik yang menghubungkan website e-commerce Anda dengan berbagai lembaga keuangan seperti Bank Transfer (Virtual Account BCA, Mandiri, BRI, BNI), E-Wallet (GoPay, OVO, ShopeePay), dan QRIS.</p>
<p>Ketika pelanggan melakukan checkout di website, payment gateway akan membuatkan tagihan unik secara otomatis. Setelah pelanggan membayar, server payment gateway akan mengirimkan webhook/callback ke website Anda, dan sistem akan langsung mengubah status pesanan menjadi <em>"Lunas"</em> dalam hitungan detik!</p>

<h2>Keuntungan Mengintegrasikan Payment Gateway di Website Anda</h2>
<ol>
    <li><strong>Verifikasi Otomatis Real-time:</strong> Tidak perlu lagi mengecek rekening koran secara manual atau meminta pelanggan mengunggah foto struk transfer.</li>
    <li><strong>Metode Pembayaran Lengkap:</strong> Pelanggan dapat memilih metode favorit mereka, mulai dari QRIS dinamis hingga Alfamart/Indomaret.</li>
    <li><strong>Keamanan Terjamin:</strong> Dilengkapi dengan sistem deteksi penipuan berstandar perbankan PCI-DSS.</li>
    <li><strong>Notifikasi Otomatis ke Pelanggan:</strong> Sistem dapat langsung memicu pengiriman pesan WhatsApp atau email konfirmasi pembayaran lunas.</li>
</ol>

<blockquote>"Otomatisasi proses checkout terbukti mampu menurunkan angka cart abandonment (keranjang belanja yang ditinggalkan) hingga lebih dari 35%."</blockquote>

<h2>Integrasi Mudah Bersama Synergy Team</h2>
<p>Tim pengembang di Synergy Team berpengalaman mengintegrasikan berbagai API Payment Gateway lokal dan internasional (Tripay, Midtrans, Xendit, Duitku) ke dalam ekosistem Laravel, WordPress/WooCommerce, maupun custom website. Konsultasikan kebutuhan sistem pembayaran Anda bersama kami hari ini!</p>',
                'author' => 'Synergy Team',
                'reading_time' => 4,
                'views' => 175,
                'is_published' => true,
                'published_at' => now()->subDays(9),
                'meta_title' => 'Strategi Integrasi API Payment Gateway Otomatis | Synergy Team',
                'meta_description' => 'Ketahui strategi ampuh integrasi API payment gateway (QRIS, VA Bank, E-Wallet) untuk toko online Anda. Pembayaran terverifikasi otomatis real-time bersama Synergy Team.',
                'meta_keywords' => 'integrasi payment gateway, tripay laravel, midtrans laravel, qris otomatis, api payment gateway, sistem pembayaran website, synergy team',
                'canonical_url' => null,
                'og_image' => 'assets/img/portfolio/project-3.png',
            ],
        ];

        foreach ($articles as $data) {
            Article::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
