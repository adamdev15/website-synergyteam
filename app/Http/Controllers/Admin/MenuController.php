<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('product')->latest()->get();
        return response()->json($menus);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'product_id'  => 'required|exists:products,id',
        ]);

        $menu = Menu::create($validated);

        return response()->json([
            'message' => 'Menu berhasil dibuat.',
            'data'    => $menu
        ], 201);
    }

    public function show($id)
    {
        return response()->json(Menu::with('product')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'product_id'  => 'required|exists:products,id',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($validated);

        return response()->json([
            'message' => 'Menu berhasil diperbarui.',
            'data'    => $menu
        ]);
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return response()->json(['message' => 'Menu berhasil dihapus.']);
    }
}
