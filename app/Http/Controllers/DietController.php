<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use Illuminate\Http\Request;

class DietController extends Controller
{
    /**
     * Display a listing of the diets.
     */
    public function index()
    {
        $diets = Diet::with('category')->get();
        
        return view('diets.index', compact('diets'));
    }

    /**
     * Display the specified diet.
     */
    public function show(Diet $diet)
    {
        $diet->load(['meals' => function ($query) {
            $query->withPivot('day')->orderBy('pivot_day');
        }, 'meals.ingredients', 'category']);
        
        return view('diets.show', compact('diet'));
    }
}
