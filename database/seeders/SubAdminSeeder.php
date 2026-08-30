<?php

namespace Database\Seeders;

use App\Models\SubAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SubAdminSeeder extends Seeder
{
    public function run(): void
    {
        SubAdmin::firstOrCreate(
            ['username' => 'subadmin'],
            [
                'password' => Hash::make('password'),
            ]
        );
    }
}
