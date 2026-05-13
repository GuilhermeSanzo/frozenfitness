<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'name',
        'description',
        'unit_price',
        'image_path',
        'category_id',
        'is_approved',
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('quantity_grams')->withTimestamps();
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class)->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getTotalKcalAttribute()
    {
        return round($this->ingredients->sum(function ($ingredient) {
            return ($ingredient->pivot->quantity_grams / 100) * $ingredient->kcal_per_100g;
        }));
    }
}
