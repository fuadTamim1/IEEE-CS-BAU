<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
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
        'publication_status',
        'rejection_note',
        'reviewed_by',
        'submitted_at',
        'reviewed_at',
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
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (Workshop $workshop): void {
            $publicationStatus = $workshop->publication_status;

            if (empty($publicationStatus)) {
                $publicationStatus = $workshop->is_published
                    ? PublicationStatus::PUBLISHED->value
                    : PublicationStatus::DRAFT->value;

                $workshop->publication_status = $publicationStatus;
            }

            $workshop->is_published = $publicationStatus === PublicationStatus::PUBLISHED->value;

            if ($publicationStatus === PublicationStatus::PENDING_REVIEW->value && ! $workshop->submitted_at) {
                $workshop->submitted_at = now();
            }
        });
    }

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

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
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
