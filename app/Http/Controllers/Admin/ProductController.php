<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('subCategory')->latest()->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'price'           => 'required|numeric',
            'description'     => 'nullable|string',
            'status'          => 'required|string',
            'link_drive'      => 'nullable|string',
            'thumbnail'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'sub_category_id.required' => 'Kategori wajib dipilih.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'status.required' => 'Status wajib dipilih.',
            'thumbnail.image' => 'File thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Format thumbnail harus jpg, jpeg, png, atau webp.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.',
            'image.image' => 'File gambar harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Upload file jika ada
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Produk berhasil dibuat.',
            'data'    => $product
        ], 201);
    }

    public function show($id)
    {
        return response()->json(Product::with('subCategory')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'price'           => 'required|numeric',
            'description'     => 'nullable|string',
            'status'          => 'required|string',
            'link_drive'      => 'nullable|string',
            'thumbnail'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'sub_category_id.required' => 'Kategori wajib dipilih.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'status.required' => 'Status wajib dipilih.',
            'thumbnail.image' => 'File thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Format thumbnail harus jpg, jpeg, png, atau webp.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.',
            'image.image' => 'File gambar harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $product = Product::findOrFail($id);

        // Upload baru jika ada file baru
        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return response()->json([
            'message' => 'Produk berhasil diperbarui.',
            'data'    => $product
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus.']);
    }
}
