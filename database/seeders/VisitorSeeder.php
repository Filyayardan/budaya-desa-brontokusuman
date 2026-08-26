<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    public function run(): void
    {
        Visitor::factory()->count(100)->create();

        Visitor::factory()
            ->count(10)
            ->state([
                'visited_at' => now(),
            ])
            ->create();
    }
}
