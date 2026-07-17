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
        Schema::create('budaya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_budaya')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->text('deskripsi_lengkap')->nullable();
            $table->string('gambar')->nullable();
            $table->string('lokasi')->nullable();
            $table->boolean('unggulan')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budaya');
    }
};
