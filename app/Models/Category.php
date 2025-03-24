<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guard = ["id","title", "created_at", "updated_at"];

    public function projects() {
        return $this->hasMany(Project::class);
    }
    
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    
}
