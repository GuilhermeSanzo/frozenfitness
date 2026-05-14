<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ingredient::create([
            'name' => 'Chicken Breast',
            'kcal_per_100g' => 165.0,
        ]);

        Ingredient::create([
            'name' => 'Sweet Potato',
            'kcal_per_100g' => 86.0,
        ]);

        Ingredient::create([
            'name' => 'Broccoli',
            'kcal_per_100g' => 34.0,
        ]);
    }
}
