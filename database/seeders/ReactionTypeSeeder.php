<?php

namespace Database\Seeders;

use App\Models\ReactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReactionType::create([
            'name' => 'Love',
            'icon' => '♥️',
        ]);

        ReactionType::create([
            'name' => 'Like',
            'icon' => '👍',
        ]);
    }
}
