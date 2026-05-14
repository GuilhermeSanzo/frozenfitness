<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/meals/{meal}', [MealController::class, 'show'])->name('meals.show');
Route::get('/diets', [DietController::class, 'index'])->name('diets.index');
Route::get('/diets/{diet}', [DietController::class, 'show'])->name('diets.show');

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

// Admin Routes
Route::middleware(['auth', 'verified', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('admin/categories', \App\Http\Controllers\Admin\CategoryController::class)
        ->names([
            'index' => 'categories.index',
            'create' => 'categories.create',
            'store' => 'categories.store',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
            'destroy' => 'categories.destroy',
        ]);

    Route::resource('admin/ingredients', \App\Http\Controllers\Admin\IngredientController::class)
        ->names([
            'index' => 'ingredients.index',
            'create' => 'ingredients.create',
            'store' => 'ingredients.store',
            'edit' => 'ingredients.edit',
            'update' => 'ingredients.update',
            'destroy' => 'ingredients.destroy',
        ]);

    Route::resource('admin/meals', \App\Http\Controllers\Admin\MealController::class)
        ->names([
            'index' => 'meals.index',
            'create' => 'meals.create',
            'store' => 'meals.store',
            'edit' => 'meals.edit',
            'update' => 'meals.update',
            'destroy' => 'meals.destroy',
        ]);

    Route::resource('admin/diets', \App\Http\Controllers\Admin\DietController::class)
        ->names([
            'index' => 'diets.index',
            'create' => 'diets.create',
            'store' => 'diets.store',
            'edit' => 'diets.edit',
            'update' => 'diets.update',
            'destroy' => 'diets.destroy',
        ]);
});

// Auth Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
