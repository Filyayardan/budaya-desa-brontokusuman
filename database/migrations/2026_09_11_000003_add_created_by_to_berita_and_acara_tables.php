<?php

use App\Models\Acara;
use App\Models\Berita;
use App\Models\SubAdmin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('penulis');
        });

        Schema::table('acara', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('penulis');
        });

        foreach (SubAdmin::all() as $sub) {
            Berita::where('penulis', $sub->username)->update(['created_by' => $sub->id]);
            Acara::where('penulis', $sub->username)->update(['created_by' => $sub->id]);
        }
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });

        Schema::table('acara', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
    }
};