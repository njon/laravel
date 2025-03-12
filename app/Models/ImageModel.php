<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'images',
        'image',
        'extra',
        'extra2',
    ];
}
