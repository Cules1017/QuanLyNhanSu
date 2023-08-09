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
        Schema::create('nhan_vien', function (Blueprint $table) {
            $table->id('ma_nhan_vien');
            $table->string('anh_nhan_vien');
            $table->string('ten')->nullable();
            $table->string('ho')->nullable();
            $table->string('cccd')->nullable();
            $table->string('email');
            $table->integer('ma_vi_tri')->default(1);
            $table->integer('ma_phong_ban')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_vien');
    }
};
