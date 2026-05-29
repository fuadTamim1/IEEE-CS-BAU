<?php

namespace App\Support;

final class SettingCatalog
{
    public const TYPE_STRING = 'string';
    public const TYPE_BOOL = 'bool';
    public const TYPE_INT = 'int';

    /**
     * @return array<string, array{type: string, default: mixed}>
     */
    public static function definitions(): array
    {
        return [
            'site_name' => ['type' => self::TYPE_STRING, 'default' => 'IEEE CS - BAU Chapter'],
            'site_logo' => ['type' => self::TYPE_STRING, 'default' => '/images/logo_name_description.svg'],
            'site_favicon' => ['type' => self::TYPE_STRING, 'default' => '/images/favicon.ico'],
            'site_tagline' => ['type' => self::TYPE_STRING, 'default' => 'Empowering future engineers'],
            'default_language' => ['type' => self::TYPE_STRING, 'default' => 'en'],
            'timezone' => ['type' => self::TYPE_STRING, 'default' => 'Asia/Amman'],
            'theme' => ['type' => self::TYPE_STRING, 'default' => 'auto'],
            'enable_maintenance_mode' => ['type' => self::TYPE_BOOL, 'default' => false],

            'show_hero_section' => ['type' => self::TYPE_BOOL, 'default' => true],
            'featured_posts_count' => ['type' => self::TYPE_INT, 'default' => 4],
            'events_to_display' => ['type' => self::TYPE_INT, 'default' => 5],
            'custom_footer_text' => ['type' => self::TYPE_STRING, 'default' => 'Copyright 2025 IEEE CS BAU. All rights reserved.'],
            'show_team_section' => ['type' => self::TYPE_BOOL, 'default' => true],
            'show_only_team_admins' => ['type' => self::TYPE_BOOL, 'default' => false],
            'enable_preloader' => ['type' => self::TYPE_BOOL, 'default' => true],

            'enable_contact_form' => ['type' => self::TYPE_BOOL, 'default' => true],
            'contact_email' => ['type' => self::TYPE_STRING, 'default' => 'cs@ieee.bau.edu.jo'],
            'whatsapp_support_number' => ['type' => self::TYPE_STRING, 'default' => '+96279xxxxxxx'],
            'facebook_page' => ['type' => self::TYPE_STRING, 'default' => 'https://facebook.com/ieeecs.bau'],
            'linkedin_page' => ['type' => self::TYPE_STRING, 'default' => 'https://linkedin.com/in/ieeecsbau'],
            'google_map_location' => ['type' => self::TYPE_STRING, 'default' => ''],
            'enable_sending_emails' => ['type' => self::TYPE_BOOL, 'default' => false],

            'registration_open' => ['type' => self::TYPE_BOOL, 'default' => true],
            'enable_login' => ['type' => self::TYPE_BOOL, 'default' => true],
            'enable_registration' => ['type' => self::TYPE_BOOL, 'default' => true],
            'default_role_on_signup' => ['type' => self::TYPE_STRING, 'default' => 'user'],
            'admin_approval_required' => ['type' => self::TYPE_BOOL, 'default' => true],
            'enable_email_verification' => ['type' => self::TYPE_BOOL, 'default' => true],

            'two_factor_auth_enabled' => ['type' => self::TYPE_BOOL, 'default' => false],
            'password_expiration_days' => ['type' => self::TYPE_INT, 'default' => 90],
            'login_attempt_limit' => ['type' => self::TYPE_INT, 'default' => 5],
            'allowed_domains_for_registration' => ['type' => self::TYPE_STRING, 'default' => '@ieee.org,@bau.edu.jo'],

            'posts_per_page' => ['type' => self::TYPE_INT, 'default' => 10],
            'allow_guest_comments' => ['type' => self::TYPE_BOOL, 'default' => false],
            'require_admin_review_before_publish' => ['type' => self::TYPE_BOOL, 'default' => true],
            'enable_markdown_editor' => ['type' => self::TYPE_BOOL, 'default' => true],

            'enable_leaderboard' => ['type' => self::TYPE_BOOL, 'default' => true],
            'top_n_weekly_members' => ['type' => self::TYPE_INT, 'default' => 5],
            'points_system_enabled' => ['type' => self::TYPE_BOOL, 'default' => true],
            'points_per_post' => ['type' => self::TYPE_INT, 'default' => 10],
            'points_per_event' => ['type' => self::TYPE_INT, 'default' => 20],
            'points_per_comment' => ['type' => self::TYPE_INT, 'default' => 5],

            'default_event_duration' => ['type' => self::TYPE_INT, 'default' => 120],
            'show_past_events' => ['type' => self::TYPE_BOOL, 'default' => true],
            'allow_rsvp' => ['type' => self::TYPE_BOOL, 'default' => true],
            'rsvp_deadline_before_event' => ['type' => self::TYPE_INT, 'default' => 48],

            'enable_github_webhooks' => ['type' => self::TYPE_BOOL, 'default' => false],
            'google_analytics_id' => ['type' => self::TYPE_STRING, 'default' => ''],
            'discord_webhook_for_new_posts' => ['type' => self::TYPE_STRING, 'default' => ''],
            'api_rate_limit' => ['type' => self::TYPE_INT, 'default' => 60],

            'dark_mode_toggle_per_user' => ['type' => self::TYPE_BOOL, 'default' => true],
            'dynamic_banner_alerts' => ['type' => self::TYPE_BOOL, 'default' => false],
            'custom_home_sections_ordering' => ['type' => self::TYPE_STRING, 'default' => ''],
            'feature_flags' => ['type' => self::TYPE_STRING, 'default' => ''],
            'file_upload_size_limit' => ['type' => self::TYPE_INT, 'default' => 10240],
        ];
    }

    /**
     * @return list<string>
     */
    public static function keys(): array
    {
        return array_keys(self::definitions());
    }

    public static function has(string $key): bool
    {
        return array_key_exists($key, self::definitions());
    }

    public static function type(string $key): string
    {
        return self::definitions()[$key]['type'] ?? self::TYPE_STRING;
    }

    public static function default(string $key, mixed $fallback = null): mixed
    {
        if (self::has($key)) {
            return self::definitions()[$key]['default'];
        }

        return $fallback;
    }

    /**
     * @return array<string, string>
     */
    public static function defaultsForStorage(): array
    {
        $defaults = [];

        foreach (self::definitions() as $key => $definition) {
            $defaults[$key] = self::normalizeForStorage($key, $definition['default']);
        }

        return $defaults;
    }

    public static function cast(string $key, mixed $value, mixed $fallback = null): mixed
    {
        if ($value === null || $value === '') {
            $value = self::default($key, $fallback);
        }

        return match (self::type($key)) {
            self::TYPE_BOOL => self::toBoolean(
                $value,
                (bool) self::default($key, $fallback ?? false),
            ),
            self::TYPE_INT => self::toInteger(
                $value,
                (int) self::default($key, $fallback ?? 0),
            ),
            default => is_scalar($value)
                ? (string) $value
                : (string) self::default($key, $fallback ?? ''),
        };
    }

    public static function normalizeForStorage(string $key, mixed $value): string
    {
        return match (self::type($key)) {
            self::TYPE_BOOL => self::toBoolean(
                $value,
                (bool) self::default($key, false),
            ) ? '1' : '0',
            self::TYPE_INT => (string) self::toInteger(
                $value,
                (int) self::default($key, 0),
            ),
            default => is_scalar($value)
                ? trim((string) $value)
                : trim((string) self::default($key, '')),
        };
    }

    private static function toBoolean(mixed $value, bool $fallback): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        if (is_int($value) || is_float($value)) {
            return (int) $value === 1;
        }

        if ($value === null) {
            return $fallback;
        }

        $normalized = strtolower(trim((string) $value));

        if (in_array($normalized, ['1', 'true', 'yes', 'on'], true)) {
            return true;
        }

        if (in_array($normalized, ['0', 'false', 'no', 'off', ''], true)) {
            return false;
        }

        return $fallback;
    }

    private static function toInteger(mixed $value, int $fallback): int
    {
        if (is_int($value)) {
            return $value;
        }

        if (is_bool($value)) {
            return $value ? 1 : 0;
        }

        if (is_float($value)) {
            return (int) round($value);
        }

        if ($value === null) {
            return $fallback;
        }

        $normalized = strtolower(trim((string) $value));

        if ($normalized === '') {
            return $fallback;
        }

        if (preg_match('/^(\d+)\s*(kb|mb|gb)$/i', $normalized, $matches) === 1) {
            $baseValue = (int) $matches[1];
            $unit = strtolower($matches[2]);

            return match ($unit) {
                'gb' => $baseValue * 1024 * 1024,
                'mb' => $baseValue * 1024,
                default => $baseValue,
            };
        }

        if (is_numeric($normalized)) {
            return (int) $normalized;
        }

        if (preg_match('/-?\d+/', $normalized, $matches) === 1) {
            return (int) $matches[0];
        }

        return $fallback;
    }
}