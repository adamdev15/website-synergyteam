<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        $subcategories = Subcategory::with('products')->get();
        return view('testimoni', compact('testimonis','subcategories'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'profil' => 'nullable|string'
        ]);

        $testimoni = Testimoni::create($validated);

        return response()->json([
            'message' => 'Testimoni berhasil dikirim.',
            'data' => $testimoni
        ], 201);
    }
}
