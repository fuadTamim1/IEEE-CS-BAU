<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Support\SettingCatalog;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        foreach (SettingCatalog::defaultsForStorage() as $key => $value) {
            Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
