<?php

use App\Models\Setting;

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