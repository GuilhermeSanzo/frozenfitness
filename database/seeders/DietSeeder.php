<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Diet;
use App\Models\Meal;
use Illuminate\Database\Seeder;

class DietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weightLoss = Category::where('name', 'Weight Loss')->first();
        $hypertrophy = Category::where('name', 'Hypertrophy')->first();

        $meals = Meal::all();

        if ($weightLoss && $meals->count() >= 2) {
            $diet1 = Diet::create([
                'name' => '14-Day Weight Loss Bootcamp',
                'description' => 'A rigorous calorie-controlled plan designed to jumpstart your weight loss journey with delicious, high-protein meals.',
                'category_id' => $weightLoss->id,
                'is_approved' => true,
            ]);

            // Assign meals to Day 1
            $diet1->meals()->attach($meals[0]->id, ['day' => 1]);
            $diet1->meals()->attach($meals[1]->id, ['day' => 1]);
            
            // Assign meals to Day 2
            $diet1->meals()->attach($meals[1]->id, ['day' => 2]);
            $diet1->meals()->attach($meals[0]->id, ['day' => 2]);
        }

        if ($hypertrophy && $meals->count() >= 2) {
            $diet2 = Diet::create([
                'name' => 'Weekly Muscle Builder',
                'description' => 'Pack on lean mass with this protein-dense meal schedule. Perfect for those looking to fuel their intense workouts.',
                'category_id' => $hypertrophy->id,
                'is_approved' => true,
            ]);

            // Assign meals to Day 1
            $diet2->meals()->attach($meals[0]->id, ['day' => 1]);
            
            // Assign meals to Day 2
            $diet2->meals()->attach($meals[1]->id, ['day' => 2]);
        }
    }
}
