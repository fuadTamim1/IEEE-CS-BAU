<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $workshops = DB::table('workshops')
            ->select('id', 'name', 'slug')
            ->orderBy('id')
            ->get();

        foreach ($workshops as $workshop) {
            if (!empty($workshop->slug)) {
                continue;
            }

            $baseSlug = Str::slug((string) $workshop->name);
            $baseSlug = $baseSlug !== '' ? $baseSlug : 'workshop';
            $slug = $baseSlug;
            $counter = 1;

            while (
                DB::table('workshops')
                    ->where('slug', $slug)
                    ->where('id', '!=', $workshop->id)
                    ->exists()
            ) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            DB::table('workshops')
                ->where('id', $workshop->id)
                ->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Intentionally left blank because we do not want to erase valid generated slugs.
    }
};
