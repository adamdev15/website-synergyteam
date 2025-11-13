<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class JasaCodingController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        $subcategories = Subcategory::with('products')->get();
        $services = [
            [
                'title' => 'Rancangan Website',
                'desc' => 'Membangun website modern, cepat, dan responsive.',
                'icon' => 'bi bi-window-desktop',
                'price' => 'Mulai dari 299k',
                'waMessage' => "Halo SynergyTeam, saya tertarik dengan layanan Rancangan Website. Mohon informasi lebih lanjut.",
            ],
            [
                'title' => 'API Integrasi',
                'desc' => 'Integrasi sistem dengan API pihak ketiga.',
                'icon' => 'bi bi-diagram-3',
                'price' => 'Mulai dari 199k',
                'waMessage' => "Halo SynergyTeam, saya tertarik dengan layanan API Integrasi. Mohon informasi lebih lanjut.",
            ],
            [
                'title' => 'Otomatisasi Script',
                'desc' => 'Otomatisasi tugas bisnis Anda dengan script custom.',
                'icon' => 'bi bi-gear-fill',
                'price' => 'Mulai dari 99k',
                'waMessage' => "Halo SynergyTeam, saya tertarik dengan layanan Otomatisasi Script. Mohon informasi lebih lanjut.",
            ],
            [
                'title' => 'Debugging & Optimization',
                'desc' => 'Perbaikan bug & optimasi performa aplikasi.',
                'icon' => 'bi bi-bug-fill',
                'price' => 'Mulai dari 49k',
                'waMessage' => "Halo SynergyTeam, saya tertarik dengan layanan Debugging & Optimization. Mohon informasi lebih lanjut.",
            ],
        ];

        $portfolios = [
            [
                'title' => 'Sistem MBKM',
                'desc' => 'Manajemen magang lengkap untuk mahasiswa dan institusi.',
                'features' => [
                    'Monitoring & Laporan Online',
                    'Penilaian Online',
                    'Mitra Kerjasama & Bimbingan Online',
                    'Konversi Online & Dashboard Admin',
                ],
                'img' => 'assets/img/portfolio/project-3.png',
                'price' => 'Mulai dari Rp1.500.000',
                'demoLink' => 'https://mbkm.stmik-tegal.ac.id',
            ],
            [
                'title' => 'Sistem Ecomarket',
                'desc' => 'Sistem bank sampah dengan marketplace UMKM.',
                'features' => [
                    'Manajemen Pengelolaan Sampah',
                    'Marketplace UMKM',
                    'Nabung Hasil Sampah',
                    'PWA Support & Push Notification',
                ],
                'img' => 'assets/img/portfolio/project-1.jpg',
                'price' => 'Mulai dari Rp800.000',
                'demoLink' => 'https://ecomarket.adamm.web.id/',
            ],
            [
                'title' => 'KesehatanKu',
                'desc' => 'Platform kesehatan berbasis ML untuk klasifikasi penyakit kulit.',
                'features' => [
                    'Cek kesehatan & konsultasi gratis',
                    'Artikel kesehatan terpercaya',
                    'Machine Learning: Klasifikasi penyakit kulit',
                    'Frontend React.js & Backend Hapi.js',
                ],
                'img' => 'assets/img/portfolio/project-2.png',
                'price' => 'Mulai dari Rp1.000.000',
                'demoLink' => '#',
            ],
        ];

        return view('jasa-coding', compact('services', 'portfolios','subcategories','testimonis'));
    }
}
