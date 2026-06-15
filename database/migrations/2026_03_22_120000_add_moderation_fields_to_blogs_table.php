<?php

use App\Enums\BlogStatus;
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
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignId('author_member_id')->nullable()->after('author_id')->constrained('members')->nullOnDelete();
            $table->string('status', 32)->default(BlogStatus::DRAFT->value)->after('is_published');
            $table->text('rejection_note')->nullable()->after('status');
            $table->foreignId('reviewed_by')->nullable()->after('rejection_note')->constrained('users')->nullOnDelete();
            $table->timestamp('submitted_at')->nullable()->after('reviewed_by');
            $table->timestamp('reviewed_at')->nullable()->after('submitted_at');
            $table->index('status');
        });

        DB::table('blogs')
            ->where('is_published', true)
            ->update([
                'status' => BlogStatus::PUBLISHED->value,
                'submitted_at' => DB::raw('COALESCE(submitted_at, created_at)'),
                'reviewed_at' => DB::raw('COALESCE(reviewed_at, created_at)'),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropConstrainedForeignId('reviewed_by');
            $table->dropColumn('reviewed_at');
            $table->dropColumn('submitted_at');
            $table->dropColumn('rejection_note');
            $table->dropColumn('status');
            $table->dropConstrainedForeignId('author_member_id');
        });
    }
};
