<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable();
            $table->string('judul_atas')->nullable();
            $table->string('judul_tengah')->nullable();
            $table->string('judul_bawah')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->string('btn1_teks')->nullable();
            $table->string('btn1_link')->nullable();
            $table->string('btn2_teks')->nullable();
            $table->string('btn2_link')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
