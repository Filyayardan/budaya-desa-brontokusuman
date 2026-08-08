<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('profil_desa') && !Schema::hasTable('profil_kampung')) {
            Schema::rename('profil_desa', 'profil_kampung');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('profil_kampung')) {
            Schema::rename('profil_kampung', 'profil_desa');
        }
    }
};
