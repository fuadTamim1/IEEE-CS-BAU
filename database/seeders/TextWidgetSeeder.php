<?php

namespace Database\Seeders;

use App\Models\TextWidget;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TextWidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $widgets = [
            ['key' => 'home_hero_title', 'value' => 'Welcome to Our Website'],
            ['key' => 'home_hero_subtitle', 'value' => 'Discover amazing content and services'],
            ['key' => 'about_page_intro', 'value' => 'Learn more about our company and mission'],
            ['key' => 'contact_page_info', 'value' => 'Get in touch with our team'],
            ['key' => 'footer_copyright', 'value' => '© 2025 Your Company. All rights reserved.'],
        ];

        foreach ($widgets as $widget) {
            TextWidget::updateOrCreate(
                ['key' => $widget['key']],
                ['value' => $widget['value']]
            );
        }
    }
}
