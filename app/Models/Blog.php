<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use Sluggable;
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
