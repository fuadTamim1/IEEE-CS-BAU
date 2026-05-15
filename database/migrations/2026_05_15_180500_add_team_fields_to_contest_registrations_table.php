<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('contest_registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('contest_registrations', 'team_name')) {
                $table->string('team_name', 120)->nullable()->after('id');
            }

            if (!Schema::hasColumn('contest_registrations', 'captain_name')) {
                $table->string('captain_name', 120)->nullable()->after('team_name');
            }

            if (!Schema::hasColumn('contest_registrations', 'captain_university_id')) {
                $table->string('captain_university_id', 60)->nullable()->after('captain_name');
            }

            if (!Schema::hasColumn('contest_registrations', 'captain_email')) {
                $table->string('captain_email', 190)->nullable()->after('captain_university_id');
            }

            if (!Schema::hasColumn('contest_registrations', 'team_size')) {
                $table->unsignedTinyInteger('team_size')->nullable()->after('captain_email');
            }

            if (!Schema::hasColumn('contest_registrations', 'member_two_name')) {
                $table->string('member_two_name', 120)->nullable()->after('team_size');
            }

            if (!Schema::hasColumn('contest_registrations', 'member_three_name')) {
                $table->string('member_three_name', 120)->nullable()->after('member_two_name');
            }
        });

        if (Schema::hasColumn('contest_registrations', 'team_size')) {
            try {
                Schema::table('contest_registrations', function (Blueprint $table) {
                    $table->index('team_size');
                });
            } catch (Throwable $exception) {
                // Ignore duplicate index creation across environments.
            }
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('contest_registrations')) {
            return;
        }

        Schema::table('contest_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('contest_registrations', 'team_size')) {
                try {
                    $table->dropIndex('contest_registrations_team_size_index');
                } catch (Throwable $exception) {
                    // Ignore missing index across database engines.
                }
            }

            $dropColumns = [];
            foreach ([
                'team_name',
                'captain_name',
                'captain_university_id',
                'captain_email',
                'team_size',
                'member_two_name',
                'member_three_name',
            ] as $column) {
                if (Schema::hasColumn('contest_registrations', $column)) {
                    $dropColumns[] = $column;
                }
            }

            if (!empty($dropColumns)) {
                $table->dropColumn($dropColumns);
            }
        });
    }
};
