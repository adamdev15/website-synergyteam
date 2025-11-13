<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        $subcategories = Subcategory::with('products')->get();
        return view('kontak', compact('subcategories','testimonis'));
    }

    // Simpan pesan ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'judul' => 'nullable|string|max:255',
            'pesan' => 'required|string',
        ]);

        Kontak::create($validated);

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
    }

    // dashboard admin
    public function list()
    {
        $kontaks = Kontak::latest()->paginate(10);
        return view('admin.kontak.index', compact('kontaks'));
    }
}
