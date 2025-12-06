<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("exam_session_id")
            ->constrained("exam_sessions")
            ->cascadeOnDelete();
            $table->foreignId("exam_tasks_id")
            ->constrained("exam_tasks")
            ->cascadeOnDelete();

            $table->dateTime("submited_at");
            $table->text("submission_text");
            $table->text("submission_file"); //path for uploaded tasks
            $table->boolean("is_correct"); // for auto correcting tasks
            $table->integer("score_awarded"); //between(task(points), 0)
            $table->text("feedback"); //notes with submissitions


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_submissions');
    }
};
