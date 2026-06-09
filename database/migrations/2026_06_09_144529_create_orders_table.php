<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Teslimat Bilgileri
            $table->string('name');
            $table->string('surname');
            $table->string('phone');
            $table->string('city');
            $table->string('district');
            $table->text('address_detail');
            
            // Ödeme ve Tutar Bilgileri
            $table->string('payment_method'); // 'kart' veya 'kapida'
            $table->decimal('total_amount', 10, 2);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};