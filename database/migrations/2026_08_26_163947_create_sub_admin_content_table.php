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
        Schema::create('sub_admin_content', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_admin_id')
                ->constrained('sub_admin')
                ->cascadeOnDelete();
            $table->foreignId('content_id')
                ->constrained('content')
                ->cascadeOnDelete();

            $table->unique(['sub_admin_id', 'content_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_admin_content');
    }
};
