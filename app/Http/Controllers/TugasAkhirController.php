<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TugasAkhirController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        $subcategories = Subcategory::with('products')->get();
        $features = [
            ['icon' => 'bi-box-seam text-primary', 'title' => 'One Project Solution', 'desc' => 'Semua kebutuhan solusi Anda terpenuhi di satu tempat'],
            ['icon' => 'bi-person-badge text-success', 'title' => 'Tim Profesional', 'desc' => 'Dikerjakan oleh Developer berpengalaman di bidangnya'],
            ['icon' => 'bi-chat-dots text-warning', 'title' => 'Konsultasi Gratis', 'desc' => 'Kami siap membantu Anda mewujudkan ide menjadi solusi digital'],
            ['icon' => 'bi-cash-coin text-danger', 'title' => 'Harga Kompetitif', 'desc' => 'Kualitas premium dengan harga tetap bersahabat'],
        ];

        return view('tugas-akhir', compact('features','subcategories','testimonis'));
    }
}
