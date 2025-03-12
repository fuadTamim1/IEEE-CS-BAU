<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
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
        "user_id",
        "category_id",
        "start_at","end_at",
        "location"
    ];

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    public function Sponsors(): BelongsToMany {
        return $this->belongsToMany(Sponsor::class, 'event_sponsor');
    }
}
