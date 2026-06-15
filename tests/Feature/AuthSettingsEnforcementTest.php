<?php

use App\Models\User;
use App\Support\AdminRoles;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

function makeAuthSettingsUser(array $attributes = []): User
{
    return User::query()->create(array_merge([
        'name' => 'Auth Settings User',
        'email' => fake()->unique()->safeEmail(),
        'password' => Hash::make('password'),
        'approval_status' => 'approved',
        'approved_at' => now(),
        'password_changed_at' => now(),
        'email_verified_at' => now(),
    ], $attributes));
}

it('blocks login page when enable_login is disabled', function () {
    set_setting('enable_login', false);

    $this->get('/login')->assertForbidden();
});

it('blocks registration when enable_registration is disabled', function () {
    set_setting('enable_registration', false);
    set_setting('registration_open', true);

    $this->get('/register')->assertForbidden();
});

it('assigns configured default role on signup when registration is allowed', function () {
    Role::findOrCreate(AdminRoles::EDITOR);

    set_setting('enable_registration', true);
    set_setting('registration_open', true);
    set_setting('default_role_on_signup', AdminRoles::EDITOR);
    set_setting('allowed_domains_for_registration', '@example.com');
    set_setting('admin_approval_required', false);
    set_setting('enable_email_verification', false);

    $response = $this->post('/register', [
        'fname' => 'Jane',
        'lname' => 'Doe',
        'email' => 'jane@example.com',
        'password' => 'StrongPass123!',
        'password_confirmation' => 'StrongPass123!',
    ]);

    $response->assertRedirect(route('filament.admin.pages.dashboard'));
    $this->assertAuthenticated();

    $user = User::query()->where('email', 'jane@example.com')->firstOrFail();
    expect($user->hasRole(AdminRoles::EDITOR))->toBeTrue();
    expect($user->approval_status)->toBe('approved');
});

it('queues newly registered users for approval when admin approval is required', function () {
    Role::findOrCreate(AdminRoles::USER);

    set_setting('enable_registration', true);
    set_setting('registration_open', true);
    set_setting('default_role_on_signup', AdminRoles::USER);
    set_setting('allowed_domains_for_registration', '@example.com');
    set_setting('admin_approval_required', true);
    set_setting('enable_email_verification', false);

    $response = $this->post('/register', [
        'fname' => 'Pending',
        'lname' => 'User',
        'email' => 'pending@example.com',
        'password' => 'StrongPass123!',
        'password_confirmation' => 'StrongPass123!',
    ]);

    $response->assertRedirect(route('login'));
    $this->assertGuest();

    $user = User::query()->where('email', 'pending@example.com')->firstOrFail();
    expect($user->approval_status)->toBe('pending');
    expect($user->approved_at)->toBeNull();
});

it('prevents pending users from logging in', function () {
    set_setting('enable_login', true);
    set_setting('enable_email_verification', false);
    set_setting('password_expiration_days', 0);

    Role::findOrCreate(AdminRoles::USER);
    $user = makeAuthSettingsUser([
        'email' => 'pending-login@example.com',
        'approval_status' => 'pending',
        'approved_at' => null,
    ]);
    $user->assignRole(AdminRoles::USER);

    $response = $this->post('/login', [
        'email' => 'pending-login@example.com',
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

it('redirects unverified users to verification notice when enabled', function () {
    set_setting('enable_login', true);
    set_setting('enable_email_verification', true);
    set_setting('password_expiration_days', 0);

    Role::findOrCreate(AdminRoles::USER);
    $user = makeAuthSettingsUser([
        'email' => 'unverified@example.com',
        'email_verified_at' => null,
    ]);
    $user->assignRole(AdminRoles::USER);

    $response = $this->post('/login', [
        'email' => 'unverified@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('verification.notice'));
    $this->assertAuthenticatedAs($user);
});

it('blocks login when password is expired', function () {
    set_setting('enable_login', true);
    set_setting('enable_email_verification', false);
    set_setting('password_expiration_days', 30);

    Role::findOrCreate(AdminRoles::USER);
    $user = makeAuthSettingsUser([
        'email' => 'expired@example.com',
        'password_changed_at' => now()->subDays(60),
    ]);
    $user->assignRole(AdminRoles::USER);

    $response = $this->post('/login', [
        'email' => 'expired@example.com',
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});
