<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\DietController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/meals/{meal}', [MealController::class, 'show'])->name('meals.show');

Route::get('/diets', [DietController::class, 'index'])->name('diets.index');
Route::get('/diets/{diet}', [DietController::class, 'show'])->name('diets.show');
