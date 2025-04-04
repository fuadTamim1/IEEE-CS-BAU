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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->string("description");
            $table->string("tags")->nullable();
            $table->enum("status", ['upcoming', 'ongoing', 'completed'])->default("upcoming");
            $table->longText("content");
            $table->text("image")->nullable();
            $table->string("location")->default("online"); //exp. Balqa Applied University - Fauilty Technology & Engineering - Amera Jana Theater
            $table->datetime("start_at");
            $table->datetime("end_at");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
