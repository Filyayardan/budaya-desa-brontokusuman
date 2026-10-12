<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sejarah_lainnya', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('ringkasan')->nullable();
            $table->longText('isi');
            $table->string('gambar')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sejarah_lainnya');
    }
};
