<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Workshop extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'cover',
        'images',
        'tags',
        'category_id',
        'start_at',
        'end_at',
        'location',
        'is_published',
        'host_name',
        'host_title',
        'host_bio',
        'host_image',
        'google_form_url',
    ];

    protected $casts = [
        'images' => 'array',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function feedback(): HasMany
    {
        return $this->hasMany(WorkshopFeedback::class)->latest();
    }

    public function getStatusAttribute(): string
    {
        $now = Carbon::now();

        if ($this->start_at && $this->end_at && $now->between($this->start_at, $this->end_at)) {
            return 'ongoing';
        }

        if ($this->start_at && $now->lt($this->start_at)) {
            return 'upcoming';
        }

        return 'past';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
