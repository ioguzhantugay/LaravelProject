<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Veritabanındaki hangi alanların doldurulabileceğini belirtiyoruz
    protected $fillable = [
        'name', 
        'surname', 
        'phone', 
        'city', 
        'district', 
        'address_detail', 
        'payment_method', 
        'total_amount'
    ];

    // Bir siparişin birden fazla ürünü olabilir (İlişki)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}