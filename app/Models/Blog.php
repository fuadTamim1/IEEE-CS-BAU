<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = [
        "title",
        "slug",
        "tags",
        "is_published",
        "description",
        "content",
        "image",
        "author_id",
        "category_id",
    ];

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    protected static function boot()
    {
        parent::boot();

        // Automatically set the author_id when creating a post
        static::creating(function ($post) {
            $post->author_id = Auth::id();
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id')->withDefault([
            'name' => 'Unknown Author', // Default value if author is null
        ]);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
