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
}
