<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        Setting::updateOrCreate(['key' => 'site_name'], ['value' => 'IEEE CS']);
        Setting::updateOrCreate(['key' => 'enable_registration'], ['value' => '1']);
    }
}
