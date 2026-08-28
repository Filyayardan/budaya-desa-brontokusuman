<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [
            ['judul' => 'berita'],
            ['judul' => 'acara'],
            ['judul' => 'galeri'],
            ['judul' => 'sejarah'],
            ['judul' => 'pengurus'],
            ['judul' => 'banner'],
        ];

        DB::table('content')->insert($contents);
    }
}