<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    /**
     * Menampilkan daftar subkategori.
     */
    public function index()
    {
        $subcategories = Subcategory::latest()->get();
        return response()->json($subcategories);
    }

    /**
     * Menyimpan subkategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'label'       => 'nullable|string',
            'description' => 'nullable|string',
            'status'      => 'required|in:public,draft',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Nama subkategori wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'thumbnail.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('subcategories', 'public');
            $validated['thumbnail'] = $path;
        }

        $subcategory = Subcategory::create($validated);

        return response()->json([
            'message' => 'Subkategori berhasil dibuat.',
            'data' => $subcategory
        ], 201);
    }

    /**
     * Menampilkan detail subkategori.
     */
    public function show($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        return response()->json($subcategory);
    }

    /**
     * Memperbarui data subkategori.
     */
    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'label'       => 'nullable|string',
            'description' => 'nullable|string',
            'status'      => 'required|in:public,draft',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Nama subkategori wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'thumbnail.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($subcategory->thumbnail && Storage::disk('public')->exists($subcategory->thumbnail)) {
                Storage::disk('public')->delete($subcategory->thumbnail);
            }
            $path = $request->file('thumbnail')->store('subcategories', 'public');
            $validated['thumbnail'] = $path;
        }

        $subcategory->update($validated);

        return response()->json([
            'message' => 'Subkategori berhasil diperbarui.',
            'data' => $subcategory
        ]);
    }

    /**
     * Menghapus subkategori.
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);

        if ($subcategory->thumbnail && Storage::disk('public')->exists($subcategory->thumbnail)) {
            Storage::disk('public')->delete($subcategory->thumbnail);
        }

        $subcategory->delete();

        return response()->json([
            'message' => 'Subkategori berhasil dihapus.'
        ]);
    }
}
