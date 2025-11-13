<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index($id)
    {
        $subcategories = Subcategory::with('products')->get();
        $product = Product::with(['subCategory', 'menus'])->findOrFail($id);

        $relatedProducts = Product::where('id', '!=', $id)
            ->inRandomOrder()
            ->take(4)
            ->get(['id', 'name', 'price', 'image', 'thumbnail']);

        $testimonials = Testimoni::inRandomOrder()
            ->take(5)
            ->get(['id', 'name', 'email', 'profil', 'testimoni', 'image_public']);

        return view('produk', compact('product', 'relatedProducts', 'testimonials', 'subcategories'));
    }
    public function showView($id)
    {
        $product = Product::with(['subCategory', 'menus'])->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan.'
            ], 404);
        }
        $relatedProducts = Product::where('id', '!=', $id)
            ->inRandomOrder()
            ->take(4)
            ->get(['id', 'name', 'price', 'image', 'thumbnail']);

        $testimonials = Testimoni::inRandomOrder()->take(5)->get();

        return response()->json([
            'success'         => true,
            'product'         => $product,
            'related_products' => $relatedProducts,
            'testimonials'    => $testimonials
        ]);
    }
    public function detailView($id)
    {
        $subcategories = Subcategory::with('products')->get();
        $product = Product::with(['subCategory', 'menus'])->findOrFail($id);

        $relatedProducts = Product::where('id', '!=', $id)
            ->inRandomOrder()
            ->take(4)
            ->get(['id', 'name', 'price', 'image', 'thumbnail']);

        $testimonials = Testimoni::inRandomOrder()
            ->take(5)
            ->get(['id', 'name', 'email', 'profil', 'testimoni', 'image_public']);

        return view('produk-detail', compact('product', 'relatedProducts', 'testimonials','subcategories'));
    }
}
