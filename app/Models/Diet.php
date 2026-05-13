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
}
