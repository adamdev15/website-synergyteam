<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        $subcategories = Subcategory::with('products')->get();
        $promos = Promo::where('is_active', true)
            ->orderByDesc('created_at')
            ->get();

        return view('promo', compact('promos','subcategories','testimonis'));
    }

    // Jika mau ditambahkan endpoint API JSON
    public function apiIndex()
    {
        return response()->json(Promo::where('is_active', true)->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promo $promo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promo $promo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promo $promo)
    {
        //
    }
}
