<?php

namespace Database\Seeders;

use App\Models\ReactionType;
use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Site::create([
            'url' => 'https://reactbar.thatalexguy.dev',
            'slug' => 'reactbar',
            'admin_slug' => 'reactbar-admin',
        ]);
    }
}
