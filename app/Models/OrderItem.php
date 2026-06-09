<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Veritabanındaki hangi alanların doldurulabileceğini belirtiyoruz
    protected $fillable = [
        'order_id', 
        'product_title', 
        'quantity', 
        'price'
    ];

    // Bu ürün hangi siparişe ait (İlişki)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}