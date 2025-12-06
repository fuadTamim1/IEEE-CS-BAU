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
        Schema::create('exam_task_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId("exam_task_id")->constrained("exam_tasks");

            $table->enum('type', ["image", "file"]);
            $table->json("meta")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_task_media');
    }
};
