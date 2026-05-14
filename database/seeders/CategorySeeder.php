<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Weight Loss',
            'color' => '#3498db', // Blue
        ]);

        Category::create([
            'name' => 'Hypertrophy',
            'color' => '#e74c3c', // Red
        ]);

        Category::create([
            'name' => 'Kids',
            'color' => '#f1c40f', // Yellow
        ]);
    }
}
