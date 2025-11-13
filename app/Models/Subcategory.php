<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';

    protected $fillable = [
        'name',
        'label',
        'description',
        'thumbnail',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id');
    }
}
