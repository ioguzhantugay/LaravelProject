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
        Schema::table('orders', function (Blueprint $table) {
            // 'user_id' sütununu ekliyoruz. 'nullable' dedik çünkü eski siparişler olabilir.
            // 'constrained' ile users tablosundaki id ile ilişkilendiriyoruz.
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Geri alırken önce foreign key'i, sonra sütunu siliyoruz.
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};