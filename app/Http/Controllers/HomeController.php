<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the public home page.
     */
    public function index()
    {
        $categories = Category::with(['meals' => function ($query) {
            $query->where('is_approved', true)
                  ->with(['ingredients', 'promotions']);
        }])->get();

        return view('home', compact('categories'));
    }
}
