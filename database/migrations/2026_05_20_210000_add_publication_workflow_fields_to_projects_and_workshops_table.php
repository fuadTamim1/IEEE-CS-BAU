<?php

use App\Enums\PublicationStatus;
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
        $this->normalizeLegacyZeroDates();

        Schema::table('projects', function (Blueprint $table) {
            $table->string('publication_status', 32)->nullable();
            $table->text('rejection_note')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->index('publication_status');
        });

        Schema::table('workshops', function (Blueprint $table) {
            $table->string('publication_status', 32)->nullable();
            $table->text('rejection_note')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->index('publication_status');
        });

        DB::table('projects')->update([
            'publication_status' => DB::raw("CASE WHEN is_published = 1 THEN '" . PublicationStatus::PUBLISHED->value . "' ELSE '" . PublicationStatus::DRAFT->value . "' END"),
            'submitted_at' => DB::raw("CASE WHEN is_published = 1 THEN COALESCE(submitted_at, created_at) ELSE submitted_at END"),
            'reviewed_at' => DB::raw("CASE WHEN is_published = 1 THEN COALESCE(reviewed_at, created_at) ELSE reviewed_at END"),
        ]);

        DB::table('workshops')->update([
            'publication_status' => DB::raw("CASE WHEN is_published = 1 THEN '" . PublicationStatus::PUBLISHED->value . "' ELSE '" . PublicationStatus::DRAFT->value . "' END"),
            'submitted_at' => DB::raw("CASE WHEN is_published = 1 THEN COALESCE(submitted_at, created_at) ELSE submitted_at END"),
            'reviewed_at' => DB::raw("CASE WHEN is_published = 1 THEN COALESCE(reviewed_at, created_at) ELSE reviewed_at END"),
        ]);
    }

    /**
     * Legacy MySQL datasets may contain zero dates that fail under strict SQL mode during ALTER TABLE.
     */
    private function normalizeLegacyZeroDates(): void
    {
        $this->normalizeZeroDateColumn('users', 'created_at', 'CURRENT_TIMESTAMP');
        $this->normalizeZeroDateColumn('users', 'updated_at', 'CURRENT_TIMESTAMP');

        $this->normalizeZeroDateColumn('projects', 'created_at', 'CURRENT_TIMESTAMP');
        $this->normalizeZeroDateColumn('projects', 'updated_at', 'CURRENT_TIMESTAMP');

        $this->normalizeZeroDateColumn('workshops', 'created_at', 'CURRENT_TIMESTAMP');
        $this->normalizeZeroDateColumn('workshops', 'updated_at', 'CURRENT_TIMESTAMP');
        $this->normalizeZeroDateColumn('workshops', 'start_at', 'NULL');
        $this->normalizeZeroDateColumn('workshops', 'end_at', 'NULL');
    }

    private function normalizeZeroDateColumn(string $table, string $column, string $replacement): void
    {
        if (! Schema::hasColumn($table, $column)) {
            return;
        }

        DB::table($table)
            ->whereRaw("CAST(`{$column}` AS CHAR) IN ('0000-00-00 00:00:00', '0000-00-00')")
            ->update([
                $column => DB::raw($replacement),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['publication_status']);
            $table->dropConstrainedForeignId('reviewed_by');
            $table->dropColumn('reviewed_at');
            $table->dropColumn('submitted_at');
            $table->dropColumn('rejection_note');
            $table->dropColumn('publication_status');
        });

        Schema::table('workshops', function (Blueprint $table) {
            $table->dropIndex(['publication_status']);
            $table->dropConstrainedForeignId('reviewed_by');
            $table->dropColumn('reviewed_at');
            $table->dropColumn('submitted_at');
            $table->dropColumn('rejection_note');
            $table->dropColumn('publication_status');
        });
    }
};