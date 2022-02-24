<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model 
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'format',
        'length_minutes',
        'release_year',
        'rating',
    ];
}
