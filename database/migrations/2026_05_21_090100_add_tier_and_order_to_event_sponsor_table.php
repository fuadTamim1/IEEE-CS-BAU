<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('event_sponsor')) {
            return;
        }

        if (! Schema::hasColumn('event_sponsor', 'tier')) {
            Schema::table('event_sponsor', function (Blueprint $table): void {
                $table->string('tier', 32)->default('partner')->after('sponsor_id');
            });
        }

        if (! Schema::hasColumn('event_sponsor', 'display_order')) {
            Schema::table('event_sponsor', function (Blueprint $table): void {
                $table->unsignedInteger('display_order')->default(0)->after('tier');
            });
        }

        DB::table('event_sponsor')->whereNull('tier')->update(['tier' => 'partner']);
        DB::table('event_sponsor')->whereNull('display_order')->update(['display_order' => 0]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('event_sponsor')) {
            return;
        }

        if (Schema::hasColumn('event_sponsor', 'display_order')) {
            Schema::table('event_sponsor', function (Blueprint $table): void {
                $table->dropColumn('display_order');
            });
        }

        if (Schema::hasColumn('event_sponsor', 'tier')) {
            Schema::table('event_sponsor', function (Blueprint $table): void {
                $table->dropColumn('tier');
            });
        }
    }
};
