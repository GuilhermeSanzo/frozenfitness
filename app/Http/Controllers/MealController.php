<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display the specified meal.
     */
    public function show(Meal $meal)
    {
        $meal->load(['ingredients', 'category']);
        
        return view('meals.show', compact('meal'));
    }
}
