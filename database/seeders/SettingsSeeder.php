<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // 🛠️ General Settings
            ['key' => 'site_name', 'value' => 'IEEE CS - BAU Chapter'],
            ['key' => 'site_logo', 'value' => '/images/logo.png'],
            ['key' => 'site_favicon', 'value' => '/images/favicon.ico'],
            ['key' => 'site_tagline', 'value' => 'Empowering future engineers'],
            ['key' => 'default_language', 'value' => 'en'],
            ['key' => 'timezone', 'value' => 'Asia/Amman'],
            ['key' => 'theme', 'value' => 'auto'],
            ['key' => 'enable_maintenance_mode', 'value' => 'false'],

            // 📢 Homepage & UI Settings
            ['key' => 'show_hero_section', 'value' => 'true'],
            ['key' => 'featured_posts_count', 'value' => '3'],
            ['key' => 'events_to_display', 'value' => '5'],
            ['key' => 'custom_footer_text', 'value' => '© IEEE CS BAU 2025'],
            ['key' => 'show_team_section', 'value' => 'true'],

            // 📬 Contact & Social
            ['key' => 'contact_email', 'value' => 'cs@ieee.bau.edu.jo'],
            ['key' => 'whatsapp_support_number', 'value' => '+96279xxxxxxx'],
            ['key' => 'facebook_page', 'value' => 'https://facebook.com/ieeecs.bau'],
            ['key' => 'linkedin_page', 'value' => 'https://linkedin.com/in/ieeecsbau'],
            ['key' => 'google_map_location', 'value' => ''],

            // 🧑‍💼 Admin & User Roles
            ['key' => 'registration_open', 'value' => 'true'],
            ['key' => 'default_role_on_signup', 'value' => 'user'],
            ['key' => 'admin_approval_required', 'value' => 'true'],
            ['key' => 'enable_email_verification', 'value' => 'true'],

            // 🔐 Security
            ['key' => 'two_factor_auth_enabled', 'value' => 'true'],
            ['key' => 'password_expiration_days', 'value' => '90'],
            ['key' => 'login_attempt_limit', 'value' => '5'],
            ['key' => 'allowed_domains_for_registration', 'value' => '@ieee.org,@bau.edu.jo'],

            // 📰 Blog & Content
            ['key' => 'posts_per_page', 'value' => '10'],
            ['key' => 'allow_guest_comments', 'value' => 'false'],
            ['key' => 'require_admin_review_before_publish', 'value' => 'true'],
            ['key' => 'enable_markdown_editor', 'value' => 'true'],

            // 🏆 Leaderboard / Gamification
            ['key' => 'enable_leaderboard', 'value' => 'true'],
            ['key' => 'top_n_weekly_members', 'value' => '5'],
            ['key' => 'points_system_enabled', 'value' => 'true'],
            ['key' => 'points_per_post', 'value' => '10'],
            ['key' => 'points_per_event', 'value' => '20'],
            ['key' => 'points_per_comment', 'value' => '5'],

            // 📆 Events & Calendar
            ['key' => 'default_event_duration', 'value' => '2 hours'],
            ['key' => 'show_past_events', 'value' => 'true'],
            ['key' => 'allow_rsvp', 'value' => 'true'],
            ['key' => 'rsvp_deadline_before_event', 'value' => '48'],

            // 🤖 DevOps / Integration
            ['key' => 'enable_github_webhooks', 'value' => 'true'],
            ['key' => 'google_analytics_id', 'value' => 'UA-xxxxxxx'],
            ['key' => 'discord_webhook_for_new_posts', 'value' => ''],
            ['key' => 'api_rate_limit', 'value' => '60'],

            // 🧩 Bonus Ideas (Advanced)
            ['key' => 'dark_mode_toggle_per_user', 'value' => 'true'],
            ['key' => 'dynamic_banner_alerts', 'value' => 'false'],
            ['key' => 'custom_home_sections_ordering', 'value' => ''],
            ['key' => 'feature_flags', 'value' => ''],
            ['key' => 'file_upload_size_limit', 'value' => '5MB'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
