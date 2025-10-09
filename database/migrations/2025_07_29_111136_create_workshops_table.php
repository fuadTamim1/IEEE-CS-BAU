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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->text("description")->nullable();
            $table->text('cover');
            $table->text('images')->nullable();

            $table->text('tags')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};