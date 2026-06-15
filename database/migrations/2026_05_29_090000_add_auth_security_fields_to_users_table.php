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
        if (!Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table): void {
            if (!Schema::hasColumn('users', 'approval_status')) {
                $table->string('approval_status', 20)->nullable()->after('email_verified_at');
                $table->index('approval_status');
            }

            if (!Schema::hasColumn('users', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('approval_status');
            }

            if (!Schema::hasColumn('users', 'password_changed_at')) {
                $table->timestamp('password_changed_at')->nullable()->after('password');
            }
        });

        DB::table('users')
            ->whereNull('approval_status')
            ->update(['approval_status' => 'approved']);

        DB::table('users')
            ->whereNull('approved_at')
            ->update(['approved_at' => DB::raw('COALESCE(email_verified_at, created_at, CURRENT_TIMESTAMP)')]);

        DB::table('users')
            ->whereNull('password_changed_at')
            ->update(['password_changed_at' => DB::raw('COALESCE(created_at, CURRENT_TIMESTAMP)')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table): void {
            if (Schema::hasColumn('users', 'approval_status')) {
                $table->dropIndex(['approval_status']);
                $table->dropColumn('approval_status');
            }

            if (Schema::hasColumn('users', 'approved_at')) {
                $table->dropColumn('approved_at');
            }

            if (Schema::hasColumn('users', 'password_changed_at')) {
                $table->dropColumn('password_changed_at');
            }
        });
    }
};
