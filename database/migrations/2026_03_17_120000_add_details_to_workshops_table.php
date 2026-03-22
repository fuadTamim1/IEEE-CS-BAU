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
        Schema::table('workshops', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name')->unique();
            $table->longText('content')->nullable()->after('description');
            $table->dateTime('start_at')->nullable()->after('content');
            $table->dateTime('end_at')->nullable()->after('start_at');
            $table->string('location')->nullable()->after('end_at');
            $table->boolean('is_published')->default(true)->after('location');

            $table->string('host_name')->nullable()->after('is_published');
            $table->string('host_title')->nullable()->after('host_name');
            $table->text('host_bio')->nullable()->after('host_title');
            $table->string('host_image')->nullable()->after('host_bio');

            $table->string('google_form_url')->nullable()->after('host_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'content',
                'start_at',
                'end_at',
                'location',
                'is_published',
                'host_name',
                'host_title',
                'host_bio',
                'host_image',
                'google_form_url',
            ]);
        });
    }
};
