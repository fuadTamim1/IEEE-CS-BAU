<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ["name", "title", "major", "contacts", "class_of_the_year", "image"];

    protected $casts = [
        'contacts' => AsArrayObject::class,
    ];
}
