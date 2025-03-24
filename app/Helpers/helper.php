<?php

use App\Models\Setting;
use App\Models\TextWidget;

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null) {
        return Setting::where('key', $key)->value('value') ?? $default;
    }
}

if (!function_exists('set_setting')) {
    function set_setting($key, $value) {
        $setting = Setting::where('key', $key)->first();
        if ($setting) {
            $setting->update(["value" => $value]);
        } else {
            Setting::create(["key" => $key, "value" => $value]);
        }
    }
}

if (!function_exists('getWidget')) {
    function getWidget($key, $default = null) {
        return TextWidget::where('key', $key)->value('value') ?? $default;
    }
}

