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
        Schema::table('projects', function (Blueprint $table) {
            $table->date('timeframe')->nullable();
            $table->text("created_by")->nullable();
            $table->float("cost")->nullable();
            $table->text("location")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('timeframe');
            $table->dropColumn("created_by");
            $table->dropColumn("cost");
            $table->dropColumn("location");
        });
    }
};
