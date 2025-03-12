<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ["name", "title", "major", "class_of_the_year", "image"];
}
