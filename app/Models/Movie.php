<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model 
{
    protected $fillable = [
        'title', 
        'format',
        'length_minutes',
        'release_year',
        'rating',
    ];
}
