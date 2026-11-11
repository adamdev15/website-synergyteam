<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Tampilkan daftar seluruh artikel di dashboard admin
     */
    public function index()
    {
        $articles = Article::latest()->get();
        return view('admin.artikel.index', compact('articles'));
    }

    /**
     * Form tambah artikel baru
     */
    public function create()
    {
        $categories = [
            'Pembuatan Website',
            'Jasa Coding',
            'API Integration',
            'Hosting & Domain',
            'Tugas Akhir',
            'Tips & Tutorial',
            'Teknologi & Bisnis',
        ];

        return view('admin.artikel.create', compact('categories'));
    }

    /**
     * Simpan artikel baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'category' => 'required|string|max:100',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'reading_time' => 'nullable|integer|min:1',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        $data = $request->except(['thumbnail', 'is_published']);

        // Handle Slug
        $slug = $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->title);
        // Pastikan slug unik
        $originalSlug = $slug;
        $counter = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $data['slug'] = $slug;

        // Handle Status Publikasi
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        // Handle Author
        if (empty($data['author'])) {
            $data['author'] = auth()->user()->name ?? 'Synergy Team';
        }

        // Handle Reading Time
        if (empty($data['reading_time'])) {
            $data['reading_time'] = Article::calculateReadingTime($request->content);
        }

        // Handle Excerpt jika kosong
        if (empty($data['excerpt'])) {
            $data['excerpt'] = Str::limit(strip_tags($request->content), 180);
        }

        // Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('uploads/articles');

            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }

            $file->move($targetDir, $fileName);
            $data['thumbnail'] = 'uploads/articles/' . $fileName;
        }

        Article::create($data);

        return redirect()->route('admin.artikel.index')
                         ->with('success', 'Artikel berhasil dibuat dan disimpan!');
    }

    /**
     * Form edit artikel
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = [
            'Pembuatan Website',
            'Jasa Coding',
            'API Integration',
            'Hosting & Domain',
            'Tugas Akhir',
            'Tips & Tutorial',
            'Teknologi & Bisnis',
        ];

        return view('admin.artikel.edit', compact('article', 'categories'));
    }

    /**
     * Update artikel yang sudah ada
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug,' . $article->id,
            'category' => 'required|string|max:100',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'reading_time' => 'nullable|integer|min:1',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:255',
        ]);

        $data = $request->except(['thumbnail', 'is_published']);

        // Handle Slug
        if ($request->filled('slug')) {
            $data['slug'] = Str::slug($request->slug);
        } else {
            $data['slug'] = Str::slug($request->title);
        }

        // Handle Status Publikasi
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published'] && empty($article->published_at) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        // Handle Reading Time
        if (empty($data['reading_time'])) {
            $data['reading_time'] = Article::calculateReadingTime($request->content);
        }

        // Upload Thumbnail baru jika ada
        if ($request->hasFile('thumbnail')) {
            // Hapus file lama jika ada di uploads/articles
            if ($article->thumbnail && File::exists(public_path($article->thumbnail))) {
                File::delete(public_path($article->thumbnail));
            }

            $file = $request->file('thumbnail');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('uploads/articles');

            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }

            $file->move($targetDir, $fileName);
            $data['thumbnail'] = 'uploads/articles/' . $fileName;
        }

        $article->update($data);

        return redirect()->route('admin.artikel.index')
                         ->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Hapus artikel
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->thumbnail && File::exists(public_path($article->thumbnail))) {
            File::delete(public_path($article->thumbnail));
        }

        $article->delete();

        return redirect()->route('admin.artikel.index')
                         ->with('success', 'Artikel berhasil dihapus!');
    }
}
