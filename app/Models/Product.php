<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'sub_category_id',
        'image',
        'link_drive',
        'thumbnail',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'sub_category_id');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}

