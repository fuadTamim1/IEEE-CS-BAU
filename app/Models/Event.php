<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        "title",
        "slug",
        "tags",
        "description",
        "status",
        "content",
        "image",
        "user_id",
        "start_at",
        "end_at",
        "location",
        "created_at",
        "updated_at"
    ];

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    public function Sponsors(): BelongsToMany {
        return $this->belongsToMany(Sponsor::class, 'event_sponsor');
    }
}
