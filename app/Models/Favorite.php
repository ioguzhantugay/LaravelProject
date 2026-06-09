<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    /**
     * Toplu atama (mass assignment) için izin verilen alanlar.
     */
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    /**
     * Bu favori kaydı bir kullanıcıya aittir.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Bu favori kaydı bir ürüne aittir.
     */
    public function product(): BelongsTo
{
    return $this->belongsTo(Product::class);
}
}