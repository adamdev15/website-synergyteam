<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'thumbnail',
        'excerpt',
        'content',
        'author',
        'reading_time',
        'views',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_image',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
        'reading_time' => 'integer',
    ];

    /**
     * Scope untuk artikel yang aktif dan sudah terbit
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where(function ($q) {
                         $q->whereNull('published_at')
                           ->orWhere('published_at', '<=', now());
                     });
    }

    /**
     * Dapatkan URL gambar thumbnail
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            if (Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
                return $this->thumbnail;
            }
            if (file_exists(public_path($this->thumbnail))) {
                return asset($this->thumbnail);
            }
            if (file_exists(public_path('storage/' . $this->thumbnail))) {
                return asset('storage/' . $this->thumbnail);
            }
            return asset($this->thumbnail);
        }

        return asset('assets/img/portfolio/project-1.jpg');
    }

    /**
     * Meta title yang efektif (fallback ke judul)
     */
    public function getEffectiveMetaTitleAttribute(): string
    {
        return $this->meta_title ?: ($this->title . ' - Synergy Team');
    }

    /**
     * Meta description yang efektif (fallback ke excerpt atau ringkasan konten)
     */
    public function getEffectiveMetaDescriptionAttribute(): string
    {
        if ($this->meta_description) {
            return $this->meta_description;
        }

        if ($this->excerpt) {
            return Str::limit(strip_tags($this->excerpt), 160);
        }

        return Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($this->content))), 160);
    }

    /**
     * OG Image yang efektif
     */
    public function getEffectiveOgImageAttribute(): string
    {
        if ($this->og_image) {
            return Str::startsWith($this->og_image, ['http://', 'https://'])
                ? $this->og_image
                : asset($this->og_image);
        }

        return $this->thumbnail_url;
    }

    /**
     * Hitung perkiraan waktu baca dalam menit
     */
    public static function calculateReadingTime(string $content): int
    {
        $words = str_word_count(strip_tags($content));
        return max(1, (int) ceil($words / 200));
    }
}

