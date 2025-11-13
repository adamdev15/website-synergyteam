<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        $subcategories = Subcategory::with('products')->get();
        return view('pembayaran', compact('subcategories','testimonis'));
    }
}
