<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['title', 'slug', 'description', 'tags', 'image', 'is_published', 'category_id', 'content', 'created_by', 'timeframe', 'cost', 'location', 'created_at', 'updated_at'];

    protected $casts = [
        'image' => 'string', // Or 'array' if using multiple images
    ];

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    // Accessor for easy URL retrieval
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    // Mutator for cleaning up paths
    public function setImageAttribute($value)
    {
        // Remove storage path if accidentally included
        $this->attributes['image'] = str_replace('storage/', '', $value);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
