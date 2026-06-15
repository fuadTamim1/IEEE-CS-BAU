<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Support\SettingCatalog;
use Illuminate\Console\Command;

class add_config extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add_config {key? : Setting key} {value? : Setting value} {--key=} {--value=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Config';

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
            $this->error('Provide a key and value. Example: php artisan add_config site_name "IEEE CS"');

            return self::FAILURE;
        }

        $settingKey = (string) $key;

        if (Setting::query()->where('key', $settingKey)->exists()) {
            $this->error("Config '{$settingKey}' already exists. Use config:update instead.");

            return self::FAILURE;
        }

        Setting::query()->create([
            'key' => $settingKey,
            'value' => SettingCatalog::normalizeForStorage($settingKey, $value),
        ]);

        $this->info("Config '{$settingKey}' created successfully.");

        return self::SUCCESS;
    }
}
