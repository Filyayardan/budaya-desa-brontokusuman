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
        Schema::table('berita', function (Blueprint $table) {
            $table->json('galeri')->nullable()->after('gambar');
        });

        Schema::table('sub_berita', function (Blueprint $table) {
            $table->json('galeri')->nullable()->after('gambar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('galeri');
        });

        Schema::table('sub_berita', function (Blueprint $table) {
            $table->dropColumn('galeri');
        });
    }
};
