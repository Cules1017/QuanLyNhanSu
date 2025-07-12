<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diem_danh', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_nhan_vien');
            $table->date('ngay');
            $table->time('gio_vao')->nullable();
            $table->time('gio_ra')->nullable();
            $table->string('trang_thai')->default('chưa điểm danh'); // chưa điểm danh, đã check in, đã check out
            $table->timestamps();

            $table->foreign('ma_nhan_vien')->references('ma_nhan_vien')->on('nhan_vien')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diem_danh');
    }
}; 