<?php

use App\Models\Setting;
use App\Support\SettingCatalog;
use App\Models\TextWidget;

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        $settingKey = (string) $key;
        $value = Setting::query()->where('key', '=', $settingKey, 'and')->value('value');

        return SettingCatalog::cast($settingKey, $value, $default);
    }
}

if (!function_exists('set_setting')) {
    function set_setting($key, $value)
    {
        $settingKey = (string) $key;

        Setting::query()->updateOrCreate(
            ['key' => $settingKey],
            ['value' => SettingCatalog::normalizeForStorage($settingKey, $value)],
        );
    }
}

if (!function_exists('getWidget')) {
    function getWidget($key, $default = null)
    {
        return TextWidget::query()->where('key', '=', $key, 'and')->value('value') ?? $default;
    }
}

