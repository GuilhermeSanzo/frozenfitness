<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Diet;
use App\Models\Meal;
use Illuminate\Http\Request;

class DietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diets = Diet::with('category')->get();
        return view('admin.diets.index', compact('diets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $meals = Meal::all();
        return view('admin.diets.create', compact('categories', 'meals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_approved' => 'boolean',
            'meals' => 'nullable|array',
            'meals.*' => 'nullable|numeric|min:1',
        ]);

        $diet = Diet::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'is_approved' => $request->has('is_approved'),
        ]);

        if (!empty($validated['meals'])) {
            $syncData = [];
            foreach ($validated['meals'] as $mealId => $day) {
                if ($day > 0) {
                    $syncData[$mealId] = ['day' => $day];
                }
            }
            $diet->meals()->sync($syncData);
        }

        return redirect('admin/diets')->with('success', 'Diet created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diet $diet)
    {
        $diet->load('meals');
        $categories = Category::all();
        $meals = Meal::all();
        return view('admin.diets.edit', compact('diet', 'categories', 'meals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diet $diet)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_approved' => 'boolean',
            'meals' => 'nullable|array',
            'meals.*' => 'nullable|numeric|min:1',
        ]);

        $diet->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'is_approved' => $request->has('is_approved'),
        ]);

        $syncData = [];
        if (!empty($validated['meals'])) {
            foreach ($validated['meals'] as $mealId => $day) {
                if ($day > 0) {
                    $syncData[$mealId] = ['day' => $day];
                }
            }
        }
        $diet->meals()->sync($syncData);

        return redirect('admin/diets')->with('success', 'Diet updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diet $diet)
    {
        $diet->delete();
        return redirect('admin/diets')->with('success', 'Diet deleted successfully.');
    }
}
