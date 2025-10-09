<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $fillable = ['name', 'description', 'cover', 'imagesUrl', 'tags', 'category_id'];

    protected $cast = [
        'images' => 'array',
    ];
}
