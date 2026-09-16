<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('profil_kampung')
            ->where('key', 'kecamatan')
            ->update(['key' => 'kemantren']);
    }

    public function down(): void
    {
        DB::table('profil_kampung')
            ->where('key', 'kemantren')
            ->update(['key' => 'kecamatan']);
    }
};