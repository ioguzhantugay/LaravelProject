<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Veritabanı ile etkileşime girerken doldurulabilir sütunlar.
     * Bu sütunlar ProductController içerisindeki create/update işlemlerinde kullanılır.
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
     * Veritabanında sütun türlerini belirtmek (opsiyonel ama iyi bir pratiktir).
     * Laravel'in veriyi işleme biçimini optimize eder.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'category_id' => 'integer',
    ];

    /**
     * İlişki: Bir ürün bir kategoriye aittir.
     * Bu sayede $product->category->name diyerek kategori adına ulaşabilirsin.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}