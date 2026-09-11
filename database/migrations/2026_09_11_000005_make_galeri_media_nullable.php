<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->string('gambar')->nullable()->change();
            $table->string('video')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->string('gambar')->nullable(false)->change();
            $table->string('video')->nullable(false)->change();
        });
    }
};