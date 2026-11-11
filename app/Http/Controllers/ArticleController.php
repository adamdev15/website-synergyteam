<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel publik (dengan filter kategori & pencarian)
     */
    public function index(Request $request)
    {
        $query = Article::published()->latest('published_at');

        // Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }

        // Pencarian Kata Kunci
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('meta_keywords', 'like', "%{$search}%");
            });
        }

        $articles = $query->paginate(9)->withQueryString();
        $categories = Article::published()->select('category')->distinct()->pluck('category');
        $popularArticles = Article::published()->orderByDesc('views')->take(4)->get();
        $subcategories = Subcategory::with('products')->get();

        $seo = [
            'title' => 'Artikel & Wawasan Teknologi Terkini - Synergy Team',
            'description' => 'Kumpulan artikel, tips website, panduan coding, dan wawasan teknologi terbaru dari tim ahli Synergy Team untuk mendukung transformasi digital bisnis Anda.',
            'keywords' => 'artikel teknologi, tips pembuatan website, jasa coding, integrasi api, software house indonesia, synergy team',
        ];

        return view('artikel.index', compact('articles', 'categories', 'popularArticles', 'subcategories', 'seo'));
    }

    /**
     * Tampilkan detail artikel berdasarkan slug (SEO Friendly)
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug);

        // Jika bukan admin yang login, hanya tampilkan yang sudah terbit
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            $article = $article->published();
        }

        $article = $article->firstOrFail();

        // Increment jumlah pembaca (views)
        $article->increment('views');

        // Artikel Terkait berdasarkan kategori yang sama
        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->latest('published_at')
            ->take(3)
            ->get();

        // Jika kurang dari 3, tambahkan artikel terbaru lainnya
        if ($relatedArticles->count() < 3) {
            $excludeIds = $relatedArticles->pluck('id')->push($article->id)->toArray();
            $additionalArticles = Article::published()
                ->whereNotIn('id', $excludeIds)
                ->latest('published_at')
                ->take(3 - $relatedArticles->count())
                ->get();
            $relatedArticles = $relatedArticles->concat($additionalArticles);
        }

        $categories = Article::published()->select('category')->distinct()->pluck('category');
        $subcategories = Subcategory::with('products')->get();

        return view('artikel.show', compact('article', 'relatedArticles', 'categories', 'subcategories'));
    }
}

