<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Veritabanında toplu atama (mass assignment) yaparken 
     * hangi sütunların doldurulabileceğini belirtiyoruz.
     * category_id'yi eklemeyi unutma!
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
        'image',
        'status',
        'category_id',
    ];

    /**
     * İlişki: Bir ürün bir kategoriye aittir.
     * (One-to-Many'nin tersi / Inverse relationship)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}