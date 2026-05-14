<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Diet;
use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegacyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Categories (formerly tipo_dieta)
        $categories = [
            1 => ['name' => 'Weight Loss', 'color' => '#3498db'],
            2 => ['name' => 'Hypertrophy', 'color' => '#e74c3c'],
            3 => ['name' => 'Kids', 'color' => '#f1c40f'],
        ];

        foreach ($categories as $id => $data) {
            Category::updateOrCreate(['id' => $id], $data);
        }

        // 2. Ingredients (formerly ingrediente)
        // Note: image_path is mapped from legacy 'caminho_imagem', stripping '../' for consistency.
        $ingredients = [
            3  => ['name' => 'White Rice', 'kcal_per_100g' => 130, 'image_path' => '../img/arroz.jpg'],
            4  => ['name' => 'Beans', 'kcal_per_100g' => 347, 'image_path' => '../img/feijao.jpg'],
            5  => ['name' => 'Brown Rice', 'kcal_per_100g' => 110, 'image_path' => '../img/arroz.jpg'], // Using same as white for now or generic
            6  => ['name' => 'Chicken Breast', 'kcal_per_100g' => 165, 'image_path' => '../img/file_frango.jpg'],
            7  => ['name' => 'Sweet Potato', 'kcal_per_100g' => 86, 'image_path' => '../img/batata_doce.jpg'],
            8  => ['name' => 'Broccoli', 'kcal_per_100g' => 34, 'image_path' => '../img/mix_de_legumes.jpg'],
            9  => ['name' => 'Beef Tenderloin', 'kcal_per_100g' => 250, 'image_path' => '../img/bife.jpg'],
            10 => ['name' => 'Tilapia Fillet', 'kcal_per_100g' => 96, 'image_path' => '../img/peixe.jpg'],
            11 => ['name' => 'Carrots', 'kcal_per_100g' => 41, 'image_path' => '../img/mix_de_legumes.jpg'],
            12 => ['name' => 'Pumpkin', 'kcal_per_100g' => 26, 'image_path' => '../img/abobora_japonesa.jpg'],
            13 => ['name' => 'Zucchini', 'kcal_per_100g' => 17, 'image_path' => '../img/mix_de_legumes.jpg'],
            14 => ['name' => 'Spinach', 'kcal_per_100g' => 23, 'image_path' => '../img/espinafre.jpg'],
            15 => ['name' => 'Eggplant', 'kcal_per_100g' => 25, 'image_path' => '../img/mix_de_legumes.jpg'],
            16 => ['name' => 'Quinoa', 'kcal_per_100g' => 120, 'image_path' => '../img/mix_de_legumes.jpg'],
            17 => ['name' => 'Lentils', 'kcal_per_100g' => 116, 'image_path' => '../img/mix_de_legumes.jpg'],
        ];

        foreach ($ingredients as $id => $data) {
            if (isset($data['image_path'])) {
                $data['image_path'] = str_replace('../', '', $data['image_path']);
            }
            Ingredient::updateOrCreate(['id' => $id], $data);
        }

        // 3. Meals (formerly prato)
        $meals = [
            7  => ['name' => 'Classic Fit Chicken', 'description' => 'Grilled chicken breast with brown rice and broccoli.', 'unit_price' => 22.90, 'category_id' => 1, 'image_path' => '../img/classico_brasileiro.jpg'],
            8  => ['name' => 'Beef & Sweet Potato', 'description' => 'Lean beef tenderloin with roasted sweet potatoes.', 'unit_price' => 26.50, 'category_id' => 1, 'image_path' => '../img/bife.jpg'],
            9  => ['name' => 'Tilapia & Quinoa', 'description' => 'Fresh tilapia fillet served with fluffy quinoa.', 'unit_price' => 24.90, 'category_id' => 1, 'image_path' => '../img/peixe.jpg'],
            10 => ['name' => 'Kids Chicken Mash', 'description' => 'Soft chicken and pumpkin mash for children.', 'unit_price' => 18.00, 'category_id' => 3, 'image_path' => '../img/sopa_de_abobora.jpg'],
            11 => ['name' => 'Bulking Beef Stew', 'description' => 'Heavy beef stew with white rice and beans.', 'unit_price' => 28.00, 'category_id' => 2, 'image_path' => '../img/bife.jpg'],
            12 => ['name' => 'Vegetarian Zucchini', 'description' => 'Baked zucchini with lentils and spinach.', 'unit_price' => 21.00, 'category_id' => 1, 'image_path' => '../img/mix_de_legumes.jpg'],
            13 => ['name' => 'Chicken & Eggplant', 'description' => 'Diced chicken with sautéed eggplant.', 'unit_price' => 23.50, 'category_id' => 1, 'image_path' => '../img/file_frango.jpg'],
            14 => ['name' => 'Lean Beef Stir-fry', 'description' => 'Beef strips with carrots and white rice.', 'unit_price' => 25.00, 'category_id' => 1, 'image_path' => '../img/bife.jpg'],
            15 => ['name' => 'Tilapia Fit', 'description' => 'Tilapia with brown rice and spinach.', 'unit_price' => 24.50, 'category_id' => 1, 'image_path' => '../img/peixe.jpg'],
            16 => ['name' => 'Kids Beef Puree', 'description' => 'Beef and carrot puree for little ones.', 'unit_price' => 19.50, 'category_id' => 3, 'image_path' => '../img/bife.jpg'],
            17 => ['name' => 'Power Chicken', 'description' => 'High protein chicken with lentils.', 'unit_price' => 23.90, 'category_id' => 1, 'image_path' => '../img/file_frango.jpg'],
            18 => ['name' => 'Hyper Beef Plate', 'description' => 'Extra beef with double portion of white rice.', 'unit_price' => 32.00, 'category_id' => 2, 'image_path' => '../img/bife.jpg'],
            19 => ['name' => 'Spinach & Quinoa Fit', 'description' => 'Light meal with quinoa and fresh spinach.', 'unit_price' => 20.50, 'category_id' => 1, 'image_path' => '../img/peixe.jpg'],
            20 => ['name' => 'Pumpkin Chicken', 'description' => 'Chicken breast with sweet pumpkin mash.', 'unit_price' => 22.00, 'category_id' => 1, 'image_path' => '../img/abobora_japonesa.jpg'],
            21 => ['name' => 'Muscle Maker Fish', 'description' => 'Large tilapia fillet with white rice.', 'unit_price' => 27.50, 'category_id' => 2, 'image_path' => '../img/peixe.jpg'],
            22 => ['name' => 'Kids Veggie Delight', 'description' => 'Pureed carrots, pumpkin and zucchini.', 'unit_price' => 15.00, 'category_id' => 3, 'image_path' => '../img/mix_de_legumes.jpg'],
            23 => ['name' => 'Chicken Lentil Soup', 'description' => 'Warm soup with chicken and lentils.', 'unit_price' => 19.90, 'category_id' => 1, 'image_path' => '../img/file_frango.jpg'],
            24 => ['name' => 'Beef & Zucchini Pasta', 'description' => 'Zucchini noodles with beef sauce.', 'unit_price' => 24.00, 'category_id' => 1, 'image_path' => '../img/bife.jpg'],
            25 => ['name' => 'White Rice & Beans Combo', 'description' => 'The traditional staple side dish.', 'unit_price' => 12.00, 'category_id' => 1, 'image_path' => '../img/arroz.jpg'],
            26 => ['name' => 'Steamed Fish & Broccoli', 'description' => 'Tilapia with steamed broccoli florets.', 'unit_price' => 23.00, 'category_id' => 1, 'image_path' => '../img/peixe.jpg'],
        ];

        foreach ($meals as $id => $data) {
            if (isset($data['image_path'])) {
                $data['image_path'] = str_replace('../', '', $data['image_path']);
            }
            Meal::updateOrCreate(['id' => $id], array_merge($data, ['is_approved' => true]));
        }

        // 4. Ingredient-Meal Pivot (formerly rel_prato_ingrediente)
        DB::table('ingredient_meal')->truncate();
        $mealIngredients = [
            ['meal_id' => 7,  'ingredient_id' => 6,  'quantity_grams' => 150],
            ['meal_id' => 7,  'ingredient_id' => 5,  'quantity_grams' => 100],
            ['meal_id' => 7,  'ingredient_id' => 8,  'quantity_grams' => 80],
            ['meal_id' => 8,  'ingredient_id' => 9,  'quantity_grams' => 180],
            ['meal_id' => 8,  'ingredient_id' => 7,  'quantity_grams' => 120],
            ['meal_id' => 9,  'ingredient_id' => 10, 'quantity_grams' => 150],
            ['meal_id' => 9,  'ingredient_id' => 16, 'quantity_grams' => 100],
            ['meal_id' => 10, 'ingredient_id' => 6,  'quantity_grams' => 100],
            ['meal_id' => 10, 'ingredient_id' => 12, 'quantity_grams' => 100],
            ['meal_id' => 11, 'ingredient_id' => 9,  'quantity_grams' => 200],
            ['meal_id' => 11, 'ingredient_id' => 3,  'quantity_grams' => 150],
            ['meal_id' => 11, 'ingredient_id' => 4,  'quantity_grams' => 100],
            ['meal_id' => 12, 'ingredient_id' => 13, 'quantity_grams' => 150],
            ['meal_id' => 12, 'ingredient_id' => 17, 'quantity_grams' => 100],
            ['meal_id' => 12, 'ingredient_id' => 14, 'quantity_grams' => 50],
        ];

        foreach ($mealIngredients as $data) {
            DB::table('ingredient_meal')->insert(array_merge($data, ['created_at' => now(), 'updated_at' => now()]));
        }

        // 5. Diets (formerly dieta and rel_dieta_prato)
        $diet = Diet::updateOrCreate(
            ['id' => 35],
            [
                'name' => 'Light Meals Plan',
                'description' => 'A selection of our lightest meals to help you stay lean and energized throughout the week.',
                'category_id' => 1,
                'is_approved' => true
            ]
        );

        DB::table('diet_meal')->where('diet_id', 35)->delete();
        $dietMeals = [
            ['diet_id' => 35, 'meal_id' => 14, 'day' => 1],
            ['diet_id' => 35, 'meal_id' => 9,  'day' => 2],
            ['diet_id' => 35, 'meal_id' => 17, 'day' => 3],
        ];

        foreach ($dietMeals as $data) {
            DB::table('diet_meal')->insert(array_merge($data, ['created_at' => now(), 'updated_at' => now()]));
        }
    }
}
