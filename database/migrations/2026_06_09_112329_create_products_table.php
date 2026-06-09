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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Ürünün adı (Örn: Micranthemum Monte Carlo)
            $table->text('description')->nullable(); // Ürün açıklaması
            $table->decimal('price', 10, 2); // Fiyatı
            $table->integer('quantity')->default(0); // Stok adedi
            $table->string('image')->nullable(); // Ürün fotoğrafının yolu
            $table->string('status')->default('True'); // Sitede aktif mi?
            $table->timestamps(); // Eklenme ve güncellenme tarihleri
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
