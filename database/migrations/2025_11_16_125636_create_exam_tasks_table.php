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
        Schema::create('exam_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')
            ->constrained('exams')
            ->cascadeOnDelete();
            
            $table->foreignId('exam_category_id')
            ->nullable()
            ->constrained('exams')
            ->nullOnDelete();
            $table->string('title');
            $table->text('description');
            $table->text('slug');
            $table->integer('points');
            $table->enum('difficulty', ["easy","meduim","hard"]);
            $table->enum('submissition_type', 
            ["flag","file","code","automatic","none"]); // submit type for each task
            $table->string("auto_flag"); //hash or plain flag
            $table->json("file_accept"); //e.g ["png","python", etc] 
            $table->text("cover_image");
            $table->text("attachment"); // attachement files comes with task description
            $table->dateTime("visible_at");
            $table->integer("order")->default(0);
            $table->json("meta")->nullable();
            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_tasks');
    }
};
