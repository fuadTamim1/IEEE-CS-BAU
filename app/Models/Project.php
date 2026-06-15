<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['title', 'slug', 'description', 'tags', 'image', 'is_published', 'publication_status', 'rejection_note', 'reviewed_by', 'submitted_at', 'reviewed_at', 'category_id', 'content', 'created_by', 'timeframe', 'cost', 'location', 'created_at', 'updated_at'];

    protected $casts = [
        'image' => 'string', // Or 'array' if using multiple images
        'is_published' => 'boolean',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (Project $project): void {
            $publicationStatus = $project->publication_status;

            if (empty($publicationStatus)) {
                $publicationStatus = $project->is_published
                    ? PublicationStatus::PUBLISHED->value
                    : PublicationStatus::DRAFT->value;

                $project->publication_status = $publicationStatus;
            }

            $project->is_published = $publicationStatus === PublicationStatus::PUBLISHED->value;

            if ($publicationStatus === PublicationStatus::PENDING_REVIEW->value && ! $project->submitted_at) {
                $project->submitted_at = now();
            }
        });
    }

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

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where(function (Builder $builder): void {
            $builder
                ->where('publication_status', PublicationStatus::PUBLISHED->value)
                ->orWhere(function (Builder $fallback): void {
                    $fallback->whereNull('publication_status')->where('is_published', true);
                });
        });
    }
}
