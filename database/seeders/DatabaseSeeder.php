<?php

namespace Database\Seeders;

use App\Models\Test;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Test::factory()->create([
            'title' => 'Test 1',
            'description' => 'This is a sample description of test 1. There is a decent amount of text here to show what it might look like on multiple lines.',
            'price' => 35,
        ]);
        Test::factory()->create([
            'title' => 'Test 2',
            'description' => 'Short description.',
            'price' => 35.99,
        ]);
        Test::factory()->create([
            'title' => 'Test 3',
            'description' => 'A medium length description.',
            'price' => 35.05,
        ]);
        Test::factory()->create([
            'title' => 'Test 4',
            'description' => 'Another medium length description.',
            'price' => 350,
        ]);
        Test::factory()->create([
            'title' => 'Test 5',
            'description' => 'This is a sample description of test 5. There is a significantly larger amount of text here to show what it might look like when the text has to overflow. Additional text in the description in case the threshold has not yet been met.',
            'price' => 3500,
        ]);
        Test::factory()->create([
            'title' => 'Test 6',
            'description' => 'Another medium length description.',
            'price' => 35,
        ]);
    }
}
