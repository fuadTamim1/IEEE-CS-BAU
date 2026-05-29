<?php

use App\Models\Setting;

it('casts boolean and integer settings from legacy values', function () {
    Setting::query()->create(['key' => 'enable_preloader', 'value' => 'false']);
    Setting::query()->create(['key' => 'enable_contact_form', 'value' => '1']);
    Setting::query()->create(['key' => 'file_upload_size_limit', 'value' => '5MB']);

    expect(get_setting('enable_preloader'))->toBeFalse();
    expect(get_setting('enable_contact_form'))->toBeTrue();
    expect(get_setting('file_upload_size_limit'))->toBe(5120);
});

it('returns catalog defaults when values are missing', function () {
    expect(get_setting('enable_login'))->toBeTrue();
    expect(get_setting('posts_per_page'))->toBe(10);
    expect(get_setting('default_event_duration'))->toBe(120);
});

it('updates only the targeted setting via config:update', function () {
    Setting::query()->create(['key' => 'site_name', 'value' => 'Old Name']);
    Setting::query()->create(['key' => 'timezone', 'value' => 'UTC']);

    $this->artisan('config:update', [
        'key' => 'site_name',
        'value' => 'IEEE Test Name',
    ])->assertExitCode(0);

    expect(Setting::query()->where('key', 'site_name')->value('value'))->toBe('IEEE Test Name');
    expect(Setting::query()->where('key', 'timezone')->value('value'))->toBe('UTC');
});

it('normalizes values during add_config command', function () {
    $this->artisan('add_config', [
        'key' => 'enable_preloader',
        'value' => 'true',
    ])->assertExitCode(0);

    expect(Setting::query()->where('key', 'enable_preloader')->value('value'))->toBe('1');
});
