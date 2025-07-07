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
        ReactionType::firstOrCreate([
            'name' => 'Love',
            'icon' => '♥️',
        ]);

        ReactionType::firstOrCreate([
            'name' => 'Like',
            'icon' => '👍',
        ]);

        ReactionType::firstOrCreate([
            'name' => 'Dislike',
            'icon' => '👎',
        ]);

        ReactionType::firstOrCreate([
            'name' => 'Upset',
            'icon' => '😠',
        ]);
    }
}
