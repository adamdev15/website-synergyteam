<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        $subcategories = Subcategory::with('products')->get();
        $faqs = [
            [
                'question' => 'Apa itu layanan digital yang Anda tawarkan?',
                'answer' => 'Kami menyediakan berbagai layanan digital termasuk pengembangan website, aplikasi mobile, sistem manajemen, dan solusi teknologi informasi lainnya. Tim kami berpengalaman dalam mengembangkan solusi yang disesuaikan dengan kebutuhan bisnis Anda.'
            ],
            [
                'question' => 'Berapa lama waktu yang dibutuhkan untuk menyelesaikan proyek?',
                'answer' => 'Waktu penyelesaian proyek bervariasi tergantung kompleksitas dan scope pekerjaan. Proyek sederhana biasanya membutuhkan 2-4 minggu, sedangkan proyek kompleks dapat memakan waktu 2-6 bulan.'
            ],
            [
                'question' => 'Apakah ada garansi untuk layanan yang diberikan?',
                'answer' => 'Ya, kami memberikan garansi untuk semua layanan yang kami berikan, mencakup perbaikan bug dan masalah teknis selama periode tertentu setelah launching.'
            ],
            [
                'question' => 'Bagaimana sistem pembayaran yang tersedia?',
                'answer' => 'Kami menyediakan berbagai metode pembayaran termasuk transfer bank, e-wallet, dan sistem digital lainnya. Pembayaran dapat dilakukan sesuai milestone proyek.'
            ],
            [
                'question' => 'Apakah layanan mencakup maintenance dan support setelah launching?',
                'answer' => 'Ya, kami menyediakan layanan maintenance dan support setelah launching, termasuk update berkala, backup data, dan monitoring performa.'
            ],
            [
                'question' => 'Bagaimana proses konsultasi dan analisis kebutuhan?',
                'answer' => 'Kami menyediakan konsultasi gratis untuk memahami kebutuhan dan tujuan bisnis Anda sebelum pengembangan dimulai.'
            ],
            [
                'question' => 'Apakah bisa request fitur khusus sesuai kebutuhan bisnis?',
                'answer' => 'Tentu saja! Kami dapat mengembangkan fitur custom sesuai workflow dan kebutuhan bisnis spesifik Anda.'
            ],
            [
                'question' => 'Bagaimana dengan keamanan data dan privacy?',
                'answer' => 'Keamanan data adalah prioritas utama kami. Kami menggunakan enkripsi dan backup berkala untuk melindungi data klien.'
            ],
        ];

        return view('faq', compact('faqs','subcategories','testimonis'));
    }

}
