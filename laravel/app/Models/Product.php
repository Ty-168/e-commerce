<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'pricing',
        'images',
        'category_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];
    // Relationship: A product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
