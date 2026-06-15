<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contest_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 120);
            $table->string('university_id', 60)->unique();
            $table->string('email', 190)->unique();
            $table->string('platform_handle', 80)->nullable();
            $table->string('preferred_language', 60);
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->string('status', 32)->default('submitted');
            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contest_registrations');
    }
};
