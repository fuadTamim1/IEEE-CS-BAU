<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    protected $fillable = 
    [
        "title",
        "description",
        "cover_image",
        "duration_minutes",
        "is_published",
        'meta',
    ];
    
   protected $casts = [
        'is_published' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'meta' => 'array',
    ];

    public function ExamTasks() : HasMany {
        return $this->hasMany(ExamTask::class, "exam_id");
    }

    public function ExamSessions() : HasMany {
        return $this->hasMany(ExamTask::class, "exam_id");
    }
}
