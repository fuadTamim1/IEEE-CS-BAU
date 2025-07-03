<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class TextConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $textConfigs = [
            // Example text configs
            ['key' => 'about_us_text', 'value' => 'We are the IEEE CS BAU Chapter, empowering future engineers.'],
            ['key' => 'homepage_banner_text', 'value' => 'Welcome to the IEEE CS BAU Chapter!'],
            ['key' => 'contact_page_info', 'value' => 'Contact us at cs@ieee.bau.edu.jo for support.'],
            ['key' => 'footer_disclaimer', 'value' => 'All rights reserved. IEEE CS BAU 2025.'],
            ['key' => 'privacy_policy_text', 'value' => 'Your privacy is important to us.'],
            ['key' => 'terms_of_service_text', 'value' => 'Please read our terms of service carefully.'],
            // Add more as needed
        ];

        foreach ($textConfigs as $config) {
            Setting::updateOrCreate(['key' => $config['key']], ['value' => $config['value']]);
        }
    }
}
