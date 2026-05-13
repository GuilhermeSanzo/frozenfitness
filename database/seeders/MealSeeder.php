<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weightLoss = Category::where('name', 'Weight Loss')->first();
        $kids = Category::where('name', 'Kids')->first();

        $chicken = Ingredient::where('name', 'Chicken Breast')->first();
        $sweetPotato = Ingredient::where('name', 'Sweet Potato')->first();
        $broccoli = Ingredient::where('name', 'Broccoli')->first();

        // Meal 1
        $meal1 = Meal::create([
            'name' => 'Classic Chicken and Sweet Potato',
            'description' => 'A staple for any fitness enthusiast.',
            'unit_price' => 25.90,
            'category_id' => $weightLoss->id,
            'is_approved' => true,
        ]);
        $meal1->ingredients()->attach($chicken->id, ['quantity_grams' => 150]);
        $meal1->ingredients()->attach($sweetPotato->id, ['quantity_grams' => 100]);

        // Meal 2
        $meal2 = Meal::create([
            'name' => 'Steamed Broccoli and Chicken',
            'description' => 'Low carb and high protein.',
            'unit_price' => 22.50,
            'category_id' => $weightLoss->id,
            'is_approved' => true,
        ]);
        $meal2->ingredients()->attach($chicken->id, ['quantity_grams' => 200]);
        $meal2->ingredients()->attach($broccoli->id, ['quantity_grams' => 100]);

        // Meal 3
        $meal3 = Meal::create([
            'name' => 'Kids Chicken and Sweet Potato Mash',
            'description' => 'Perfectly portioned for children.',
            'unit_price' => 18.00,
            'category_id' => $kids->id,
            'is_approved' => true,
        ]);
        $meal3->ingredients()->attach($chicken->id, ['quantity_grams' => 100]);
        $meal3->ingredients()->attach($sweetPotato->id, ['quantity_grams' => 80]);
    }
}
