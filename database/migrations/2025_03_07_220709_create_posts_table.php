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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string('slug')->unique();
            $table->string("tags");
            $table->text("content");
            $table->text("image")->nullable();
            $table->boolean("is_published")->default(true);
            $table->foreignId("user_id")->constrained()->cascadeOnUpdate()->nullOnDelete("set null");
            $table->foreignId("catagory_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
