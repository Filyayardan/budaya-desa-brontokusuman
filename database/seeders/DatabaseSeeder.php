<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(BudayaSeeder::class);
        $this->call(UmkmSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ProfilKampungSeeder::class);
        $this->call(VisitorSeeder::class);
    }
}
