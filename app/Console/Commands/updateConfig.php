<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Support\SettingCatalog;
use Illuminate\Console\Command;

class updateConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:update {key? : Setting key} {value? : Setting value} {--key=} {--value=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update an existing config setting';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $key = $this->argument('key') ?: $this->option('key');
        $value = $this->argument('value');

        if ($value === null) {
            $value = $this->option('value');
        }

        if (!$key || $value === null) {
            $this->error('Provide a key and value. Example: php artisan config:update site_name "IEEE CS"');

            return self::FAILURE;
        }

        $settingKey = (string) $key;
        $normalizedValue = SettingCatalog::normalizeForStorage($settingKey, $value);

        Setting::query()->updateOrCreate(
            ['key' => $settingKey],
            ['value' => $normalizedValue],
        );

        $this->info("Config '{$settingKey}' updated successfully.");

        return self::SUCCESS;
    }
}
