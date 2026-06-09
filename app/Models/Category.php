<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Veritabanında toplu veri girişi yaparken doldurulabilir alanlar
    protected $fillable = ['name'];

    /**
     * İlişki: Bir kategorinin birçok ürünü olabilir.
     * (One-to-Many Relationship)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}