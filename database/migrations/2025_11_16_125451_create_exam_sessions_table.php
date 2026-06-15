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
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("exam_id")
            ->constrained("exams")
            ->cascadeOnDelete();
            $table->text("token");
            $table->string("full_name");
            $table->string("email");
            $table->string("phone");
            $table->dateTime("started_at");
            $table->dateTime("ended_at");
            $table->integer("score");
            $table->enum('status',["pending","active","submitted","expired"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_sessions');
    }
};
