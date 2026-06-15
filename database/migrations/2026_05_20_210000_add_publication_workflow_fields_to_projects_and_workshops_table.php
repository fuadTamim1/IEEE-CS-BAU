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

        $this->addPublicationWorkflowColumns('projects');
        $this->addPublicationWorkflowColumns('workshops');

        $this->backfillPublicationWorkflow('projects');
        $this->backfillPublicationWorkflow('workshops');
    }

    private function addPublicationWorkflowColumns(string $table): void
    {
        if (! Schema::hasTable($table)) {
            return;
        }

        $hasPublicationStatus = Schema::hasColumn($table, 'publication_status');
        $hasRejectionNote = Schema::hasColumn($table, 'rejection_note');
        $hasReviewedBy = Schema::hasColumn($table, 'reviewed_by');
        $hasSubmittedAt = Schema::hasColumn($table, 'submitted_at');
        $hasReviewedAt = Schema::hasColumn($table, 'reviewed_at');

        if ($hasPublicationStatus && $hasRejectionNote && $hasReviewedBy && $hasSubmittedAt && $hasReviewedAt) {
            return;
        }

        Schema::table($table, function (Blueprint $blueprint) use ($hasPublicationStatus, $hasRejectionNote, $hasReviewedBy, $hasSubmittedAt, $hasReviewedAt): void {
            if (! $hasPublicationStatus) {
                $blueprint->string('publication_status', 32)->nullable();
                $blueprint->index('publication_status');
            }

            if (! $hasRejectionNote) {
                $blueprint->text('rejection_note')->nullable();
            }

            if (! $hasReviewedBy) {
                $blueprint->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            }

            if (! $hasSubmittedAt) {
                $blueprint->timestamp('submitted_at')->nullable();
            }

            if (! $hasReviewedAt) {
                $blueprint->timestamp('reviewed_at')->nullable();
            }
        });
    }

    private function backfillPublicationWorkflow(string $table): void
    {
        if (! Schema::hasTable($table) || ! Schema::hasColumn($table, 'is_published')) {
            return;
        }

        $updates = [];

        if (Schema::hasColumn($table, 'publication_status')) {
            $updates['publication_status'] = DB::raw("CASE WHEN is_published = 1 THEN '" . PublicationStatus::PUBLISHED->value . "' ELSE '" . PublicationStatus::DRAFT->value . "' END");
        }

        if (Schema::hasColumn($table, 'submitted_at')) {
            $updates['submitted_at'] = DB::raw("CASE WHEN is_published = 1 THEN COALESCE(submitted_at, created_at) ELSE submitted_at END");
        }

        if (Schema::hasColumn($table, 'reviewed_at')) {
            $updates['reviewed_at'] = DB::raw("CASE WHEN is_published = 1 THEN COALESCE(reviewed_at, created_at) ELSE reviewed_at END");
        }

        if ($updates === []) {
            return;
        }

        DB::table($table)->update($updates);
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
        $this->dropPublicationWorkflowColumns('projects');
        $this->dropPublicationWorkflowColumns('workshops');
    }

    private function dropPublicationWorkflowColumns(string $table): void
    {
        if (! Schema::hasTable($table)) {
            return;
        }

        if (Schema::hasColumn($table, 'reviewed_by')) {
            Schema::table($table, function (Blueprint $blueprint): void {
                $blueprint->dropConstrainedForeignId('reviewed_by');
            });
        }

        Schema::table($table, function (Blueprint $blueprint) use ($table): void {
            if (Schema::hasColumn($table, 'reviewed_at')) {
                $blueprint->dropColumn('reviewed_at');
            }

            if (Schema::hasColumn($table, 'submitted_at')) {
                $blueprint->dropColumn('submitted_at');
            }

            if (Schema::hasColumn($table, 'rejection_note')) {
                $blueprint->dropColumn('rejection_note');
            }

            if (Schema::hasColumn($table, 'publication_status')) {
                $blueprint->dropColumn('publication_status');
            }
        });
    }
};