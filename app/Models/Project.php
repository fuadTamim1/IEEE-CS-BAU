<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['title', 'slug', 'description', 'tags', 'image', 'is_published', 'category_id', 'content', 'created_at', 'updated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }
}
