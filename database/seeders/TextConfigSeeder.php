<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\TextWidget;

class TextConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $textConfigs = [
            ['key' => 'home_hero_title', 'value' => 'Welcome to Our Website'],
            ['key' => 'home_hero_subtitle', 'value' => 'Discover amazing content and services'],
            ['key' => 'about_page_intro', 'value' => 'Learn more about our company and missions'],
            ['key' => 'contact_page_info', 'value' => 'Get in touch with our team'],
            ['key' => 'footer_copyright', 'value' => '© 2025 Your Company. All rights reserved.'],
            ['key' => 'facebook-link', 'value' => 'https://web.facebook.com/groups/232534844172880'],
            ['key' => 'instagram-link', 'value' => 'https://www.instagram.com/ieee_bau_cs/'],
            ['key' => 'linkedin-link', 'value' => 'https://www.linkedin.com/company/ieee-bau-cs-computer-society/'],
            ['key' => 'location', 'value' => 'Al Balqa Applied University Engineering Technology College, Al Hizam Al Daeri St 527, Amman'],
            ['key' => 'email', 'value' => 'ieeecsbau@ieee.org'],
            ['key' => 'google_map_locaction', 'value' => 'https://maps.app.goo.gl/V5Lx9KGiZb12265F7'],
        ];

        foreach ($textConfigs as $config) {
            TextWidget::updateOrCreate(['key' => $config['key']], ['value' => $config['value']]);
        }
    }
}
