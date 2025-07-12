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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de', 255);
            $table->text('noi_dung');
            $table->enum('loai', ['mail', 'in-app']);
            $table->unsignedBigInteger('nguoi_gui_id');
            $table->timestamps();

            $table->foreign('nguoi_gui_id')->references('id')->on('nguoi_quan_tri')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
