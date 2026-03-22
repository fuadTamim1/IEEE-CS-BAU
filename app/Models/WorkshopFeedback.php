<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkshopFeedback extends Model
{
    protected $table = 'workshop_feedback';

    protected $fillable = [
        'workshop_id',
        'user_id',
        'author_name',
        'author_email',
        'rating',
        'comment',
    ];

    public function workshop(): BelongsTo
    {
        return $this->belongsTo(Workshop::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
