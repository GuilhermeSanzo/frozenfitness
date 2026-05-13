<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meals = Meal::with('category')->get();
        return view('admin.meals.index', compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('admin.meals.create', compact('categories', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'unit_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_approved' => 'boolean',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'nullable|numeric|min:0',
        ]);

        $meal = Meal::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'unit_price' => $validated['unit_price'],
            'category_id' => $validated['category_id'],
            'is_approved' => $request->has('is_approved'),
        ]);

        if (!empty($validated['ingredients'])) {
            $syncData = [];
            foreach ($validated['ingredients'] as $id => $quantity) {
                if ($quantity > 0) {
                    $syncData[$id] = ['quantity_grams' => $quantity];
                }
            }
            $meal->ingredients()->sync($syncData);
        }

        return redirect()->route('meals.index')->with('success', 'Meal created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meal $meal)
    {
        $meal->load('ingredients');
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return view('admin.meals.edit', compact('meal', 'categories', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meal $meal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'unit_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_approved' => 'boolean',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'nullable|numeric|min:0',
        ]);

        $meal->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'unit_price' => $validated['unit_price'],
            'category_id' => $validated['category_id'],
            'is_approved' => $request->has('is_approved'),
        ]);

        $syncData = [];
        if (!empty($validated['ingredients'])) {
            foreach ($validated['ingredients'] as $id => $quantity) {
                if ($quantity > 0) {
                    $syncData[$id] = ['quantity_grams' => $quantity];
                }
            }
        }
        $meal->ingredients()->sync($syncData);

        return redirect()->route('meals.index')->with('success', 'Meal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        $meal->delete();
        return redirect()->route('meals.index')->with('success', 'Meal deleted successfully.');
    }
}
