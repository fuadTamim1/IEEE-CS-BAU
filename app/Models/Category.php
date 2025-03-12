<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guard = ["id", "created_at", "updated_at"];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    
}
