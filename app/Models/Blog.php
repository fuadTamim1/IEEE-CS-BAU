<?php

namespace App\Models;

use App\Enums\BlogStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        "title",
        "slug",
        "tags",
        "is_published",
        "status",
        "rejection_note",
        "reviewed_by",
        "submitted_at",
        "reviewed_at",
        "description",
        "content",
        "image",
        "author_id",
        "author_member_id",
        "category_id",
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    protected $appends = ['display_author_name'];

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Blog $post) {
            if (!$post->author_id) {
                $post->author_id = Auth::id();
            }

            if (!$post->status) {
                $post->status = BlogStatus::DRAFT->value;
            }
        });

        static::saving(function (Blog $post) {
            $status = $post->status ?: BlogStatus::DRAFT->value;
            $post->is_published = $status === BlogStatus::PUBLISHED->value;

            if ($status === BlogStatus::PENDING_REVIEW->value && !$post->submitted_at) {
                $post->submitted_at = now();
            }
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

    public function authorMember(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'author_member_id');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', BlogStatus::PUBLISHED->value);
    }

    public function getDisplayAuthorNameAttribute(): string
    {
        if (!empty($this->authorMember?->name)) {
            return $this->authorMember->name;
        }

        if (!empty($this->author?->name)) {
            return $this->author->name;
        }

        return 'Unknown Author';
    }
}
