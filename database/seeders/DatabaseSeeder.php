<?php

namespace Database\Seeders;

use App\Models\Page;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Page::factory()->create([
            'title' => 'Home',
            'icon' => 'bi-house-fill',
            'link' => '/',
        ]);
        Page::factory()->create([
            'title' => 'FAQ',
            'icon' => 'bi-question-circle-fill',
            'link' => '/faq',
        ]);
        Page::factory()->create([
            'title' => 'Tests',
            'icon' => 'bi-file-earmark-fill',
            'link' => '/tests',
        ]);
    }
}
