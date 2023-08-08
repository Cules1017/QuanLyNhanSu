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
        Schema::create('luong', function (Blueprint $table) {
            $table->id('ma_luong');
            $table->integer('ma_nhan_vien');
            $table->float('tien_luong');
            $table->date('ngay_cap_nhat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luong');
    }
};
