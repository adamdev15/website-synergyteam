<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class ApiIntegrationController extends Controller
{
    public function index() {
        $testimonis = Testimoni::latest()->get();
        $subcategories = Subcategory::with('products')->get();
        return view('api', compact('testimonis','subcategories'));
    }
}
