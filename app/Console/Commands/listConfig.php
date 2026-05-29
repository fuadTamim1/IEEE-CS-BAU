<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Support\SettingCatalog;
use Illuminate\Console\Command;

class listConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:list {--key= : Filter by key substring}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows all configs settings';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $query = Setting::query()->orderBy('key', 'asc');
        $filter = trim((string) $this->option('key'));

        if ($filter !== '') {
            $query->where('key', 'like', '%' . $filter . '%');
        }

        $settings = $query->get(['key', 'value']);

        if ($settings->isEmpty()) {
            $this->warn('No settings found.');

            return self::SUCCESS;
        }

        $rows = $settings
            ->values()
            ->map(function (Setting $setting, int $index): array {
                return [
                    $index + 1,
                    $setting->key,
                    SettingCatalog::type($setting->key),
                    (string) SettingCatalog::cast($setting->key, $setting->value),
                ];
            })
            ->all();

        $this->table(['Idx', 'Key', 'Type', 'Value'], $rows);

        return self::SUCCESS;
    }
}
