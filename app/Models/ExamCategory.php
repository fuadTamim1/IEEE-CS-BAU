<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamCategory extends Model
{
    protected $fillable =
    [
        "title",
        "description"
    ];

    public function ExamTasks() : HasMany {
        return $this->hasMany(ExamTask::class, "exam_category_id");
    }
}
