<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Database\Seeders\ArticleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ArticleSeeder::class);
    }

    public function test_home_page_renders_articles_section(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Artikel &amp; Wawasan Digital', false);
    }

    public function test_articles_index_page_loads(): void
    {
        $response = $this->get('/artikel');
        $response->assertStatus(200);
        $response->assertSee('Artikel &amp; Wawasan Digital', false);
    }

    public function test_article_detail_page_loads_with_seo_tags(): void
    {
        $article = Article::first();
        $this->assertNotNull($article);

        $response = $this->get('/artikel/' . $article->slug);
        $response->assertStatus(200);
        $response->assertSee($article->title);
        $response->assertSee('application/ld+json', false);
        $response->assertSee($article->effective_meta_description);
        $response->assertSee('Artikel Terkait');
    }

    public function test_admin_can_view_article_management(): void
    {
        $role = Role::firstOrCreate(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('/admin/artikel');
        $response->assertStatus(200);
        $response->assertSee('Kelola Artikel &amp; SEO', false);
        $response->assertSee('Tulis Artikel Baru');
    }

    public function test_admin_can_create_article(): void
    {
        $role = Role::firstOrCreate(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->post('/admin/artikel', [
            'title' => 'Tutorial Belajar Laravel 12 untuk Pemula',
            'slug' => 'tutorial-belajar-laravel-12-pemula',
            'category' => 'Tips & Tutorial',
            'excerpt' => 'Panduan lengkap memahami framework Laravel 12 dari dasar sampai mahir.',
            'content' => '<h2>Mengenal Laravel 12</h2><p>Laravel adalah framework PHP modern.</p>',
            'meta_title' => 'Tutorial Belajar Laravel 12 Pemula | Synergy Team',
            'meta_description' => 'Pelajari Laravel 12 mulai dari instalasi hingga routing dan controller bersama Synergy Team.',
            'is_published' => 1,
        ]);

        $response->assertRedirect(route('admin.artikel.index'));
        $this->assertDatabaseHas('articles', [
            'slug' => 'tutorial-belajar-laravel-12-pemula',
        ]);
    }
}
