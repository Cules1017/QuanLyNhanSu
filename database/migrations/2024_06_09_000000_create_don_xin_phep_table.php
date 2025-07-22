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
        Schema::create('don_xin_phep', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_nhan_vien');
            $table->enum('loai_nghi', ['co_luong', 'khong_luong']);
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->text('ly_do')->nullable();
            $table->enum('trang_thai', ['cho_duyet', 'da_duyet', 'tu_choi'])->default('cho_duyet');
            $table->text('ly_do_tu_choi')->nullable();
            $table->timestamps();

            $table->foreign('ma_nhan_vien')->references('ma_nhan_vien')->on('nhan_vien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_xin_phep');
    }
}; 