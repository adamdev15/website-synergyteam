<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class PembuatanWebsiteController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        $subcategories = Subcategory::with('products')->get();
        $projects = [
            [
                'title' => 'Sistem MBKM',
                'desc' => 'Manajemen magang lengkap untuk mahasiswa dan institusi, memudahkan pelaporan dan monitoring kegiatan magang.',
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
                'desc' => 'Sistem bank sampah dengan marketplace UMKM, mendukung pengelolaan sampah dan transaksi produk lokal.',
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
                'desc' => 'Platform kesehatan berbasis ML, menyediakan informasi kesehatan dan fitur cek kesehatan secara digital.',
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

        return view('pembuatan-website', compact('projects','subcategories','testimonis'));
    }
}
