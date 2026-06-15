<?php

use App\Support\SettingCatalog;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('settings')) {
            return;
        }

        DB::table('settings')
            ->select(['id', 'key', 'value'])
            ->orderBy('id')
            ->chunkById(200, function ($rows): void {
                foreach ($rows as $row) {
                    $normalizedValue = SettingCatalog::normalizeForStorage($row->key, $row->value);

                    if ((string) $row->value === $normalizedValue) {
                        continue;
                    }

                    DB::table('settings')
                        ->where('id', $row->id)
                        ->update(['value' => $normalizedValue]);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Normalization is intentionally non-destructive and does not require rollback.
    }
};