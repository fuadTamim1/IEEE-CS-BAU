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
        if (! Schema::hasTable('sponsors')) {
            return;
        }

        if (! Schema::hasColumn('sponsors', 'description')) {
            Schema::table('sponsors', function (Blueprint $table): void {
                $table->string('description')->nullable()->after('descrition');
            });
        }

        if (Schema::hasColumn('sponsors', 'descrition') && Schema::hasColumn('sponsors', 'description')) {
            DB::table('sponsors')
                ->where(function ($query): void {
                    $query->whereNull('description')->orWhere('description', '');
                })
                ->update([
                    'description' => DB::raw('descrition'),
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('sponsors')) {
            return;
        }

        if (Schema::hasColumn('sponsors', 'description') && Schema::hasColumn('sponsors', 'descrition')) {
            DB::table('sponsors')
                ->where(function ($query): void {
                    $query->whereNull('descrition')->orWhere('descrition', '');
                })
                ->update([
                    'descrition' => DB::raw('description'),
                ]);
        }

        if (Schema::hasColumn('sponsors', 'description')) {
            Schema::table('sponsors', function (Blueprint $table): void {
                $table->dropColumn('description');
            });
        }
    }
};
