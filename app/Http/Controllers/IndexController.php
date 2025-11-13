<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $testimonials = Testimoni::latest()->take(6)->get();
        $subcategories = Subcategory::with('products')->get();
        $product = Product::all();

        $services = [
            [
                'image' => 'assets/img/icon/jasacoding.png',
                'title' => 'Jasa Coding Anda',
                'description' => 'Layanan pembuatan dan pengembangan aplikasi sesuai kebutuhan proyek Anda.',
                'path' => '/jasa-coding',
            ],
            [
                'image' => 'assets/img/icon/pembuatanwebsite.png',
                'title' => 'Pembuatan Website',
                'description' => 'Website profesional untuk bisnis, portofolio, atau organisasi Anda.',
                'path' => '/pembuatan-website',
            ],
            [
                'image' => 'assets/img/icon/api.png',
                'title' => 'API Integration App',
                'description' => 'Integrasi aplikasi dengan API untuk meningkatkan efisiensi sistem.',
                'path' => '/api-integration-app',
            ],
            [
                'image' => 'assets/img/icon/hostingdomain.png',
                'title' => 'Hosting & Domain',
                'description' => 'Layanan hosting cepat dan aman dengan domain eksklusif Anda.',
                'path' => '/hosting-domain',
            ],
            [
                'image' => 'assets/img/icon/website.jpg',
                'title' => 'Website & Sistem Development',
                'description' => 'Sistem berbasis web sesuai kebutuhan bisnis Anda.',
                'path' => '/website-sistem-development',
            ],
            [
                'image' => 'assets/img/icon/ta.png',
                'title' => 'Layanan Sistem Tugas Akhir',
                'description' => 'Platform pendukung pengerjaan tugas akhir mahasiswa.',
                'path' => '/layanan-tugas-akhir',
            ],
        ];

        return view('home', compact('services', 'testimonials','subcategories'));
    }
    public function tentangKami()
    {
        $testimonials = Testimoni::latest()->take(6)->get();
        $subcategories = Subcategory::with('products')->get();

        $services = [
            [
                'image' => 'assets/img/icon/jasacoding.png',
                'title' => 'Jasa Coding Anda',
                'description' => 'Layanan pembuatan dan pengembangan aplikasi sesuai kebutuhan proyek Anda.',
                'path' => '/jasa-coding',
            ],
            [
                'image' => 'assets/img/icon/pembuatanwebsite.png',
                'title' => 'Pembuatan Website',
                'description' => 'Website profesional untuk bisnis, portofolio, atau organisasi Anda.',
                'path' => '/pembuatan-website',
            ],
            [
                'image' => 'assets/img/icon/api.png',
                'title' => 'API Integration App',
                'description' => 'Integrasi aplikasi dengan API untuk meningkatkan efisiensi sistem.',
                'path' => '/api-integration-app',
            ],
            [
                'image' => 'assets/img/icon/hostingdomain.png',
                'title' => 'Hosting & Domain',
                'description' => 'Layanan hosting cepat dan aman dengan domain eksklusif Anda.',
                'path' => '/hosting-domain',
            ],
            [
                'image' => 'assets/img/icon/website.jpg',
                'title' => 'Website & Sistem Development',
                'description' => 'Sistem berbasis web sesuai kebutuhan bisnis Anda.',
                'path' => '/website-sistem-development',
            ],
            [
                'image' => 'assets/img/icon/ta.png',
                'title' => 'Layanan Sistem Tugas Akhir',
                'description' => 'Platform pendukung pengerjaan tugas akhir mahasiswa.',
                'path' => '/layanan-tugas-akhir',
            ],
        ];

        return view('tentang-kami', compact('services', 'testimonials','subcategories'));
    }

    public function riwayatTransaksi()
    {
        $testimonials = Testimoni::latest()->take(6)->get();
        $subcategories = Subcategory::with('products')->get();
        $orders = Order::with(['items.product', 'payment'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('riwayat-transaksi', compact('orders','subcategories','testimonials'));
    }
    public function akunSaya()
    {
        $testimonials = Testimoni::latest()->take(6)->get();
        $subcategories = Subcategory::with('products')->get();
        $user = Auth::user();

        $lastOrder = Order::with(['items.product', 'payment'])
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        return view('akun-saya', compact('user', 'lastOrder','subcategories','testimonials'));
    }
}
