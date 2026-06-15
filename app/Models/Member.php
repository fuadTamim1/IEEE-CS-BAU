<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Stringable as Str;

class Member extends Model
{
    protected $fillable = ["name", "title", "major", "contacts", "class_of_the_year", "image","order","story"];

    protected $casts = [
        'contacts' => AsArrayObject::class,
    ];

    public function hasStory() : bool 
    {
        return strlen($this->story) > 15;
    }
}
