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
        Schema::create('exam_leaderboards', function (Blueprint $table) {
            $table->id();
            $table->foreignId("exam_id")
            ->constrained("exams")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            
            $table->foreignId("exam_session_id")
            ->constrained("exam_sessions")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->integer("score")->default(0);
            $table->integer("rank")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_leaderboards');
    }
};
