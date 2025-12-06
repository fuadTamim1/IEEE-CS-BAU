<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamSession extends Model
{
    protected $fillable = 
    [
        "exam_id",
        "token",
        "full_name",
        "email",
        "phone",
        "started_at",
        "ended_at",
        "score",
        "status",
    ];

    public function Exam(): BelongsTo {
        return $this->belongsTo(Exam::class, "exam_id");
    }

    public function ExamTasks() : HasMany {
        return $this->hasMany(ExamTask::class, "exam_id");
    }
}
