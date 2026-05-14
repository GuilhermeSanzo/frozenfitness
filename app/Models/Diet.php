<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'is_approved',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class)->withPivot('day')->withTimestamps();
    }
}
