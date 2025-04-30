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
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->id();
            $table->date('week_start_date')->nullable();
            $table->dateTime('publish_at')->nullable();
            $table->string('title')->nullable();
            $table->foreignId('member_1_id')->constrained('members');
            $table->foreignId('member_2_id')->nullable()->constrained('members');
            $table->foreignId('member_3_id')->nullable()->constrained('members');
            $table->foreignId('member_4_id')->nullable()->constrained('members');
            $table->foreignId('member_5_id')->nullable()->constrained('members');
            $table->foreignId('member_6_id')->nullable()->constrained('members');
            $table->foreignId('member_7_id')->nullable()->constrained('members');
            $table->foreignId('member_8_id')->nullable()->constrained('members');
            $table->foreignId('member_9_id')->nullable()->constrained('members');
            $table->foreignId('member_10_id')->nullable()->constrained('members');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaderboards');
    }
};
