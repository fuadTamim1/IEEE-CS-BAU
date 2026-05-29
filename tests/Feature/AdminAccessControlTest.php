<?php

use App\Http\Middleware\EnsureUserHasAdminAccess;
use App\Models\User;
use App\Policies\FilamentUserPolicy;
use App\Support\AdminRoles;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

function registerAdminGateTestRoute(): void
{
    static $registered = false;

    if ($registered) {
        return;
    }

    Route::middleware(EnsureUserHasAdminAccess::class)
        ->get('/__test/admin-gate', fn () => response('ok', 200));

    $registered = true;
}

it('grants filament access to all admin panel roles and blocks regular users', function () {
    $policy = app(FilamentUserPolicy::class);

    foreach (AdminRoles::adminAccessRoles() as $role) {
        Role::findOrCreate($role);

        $user = User::factory()->create();
        $user->assignRole($role);

        expect($policy->access($user))->toBeTrue();
    }

    Role::findOrCreate(AdminRoles::USER);
    $regularUser = User::factory()->create();
    $regularUser->assignRole(AdminRoles::USER);

    expect($policy->access($regularUser))->toBeFalse();
});

it('recognizes canonical and legacy super admin roles', function () {
    foreach (AdminRoles::superAdminRoles() as $role) {
        Role::findOrCreate($role);

        $user = User::factory()->create();
        $user->assignRole($role);

        expect($user->isSuperAdmin())->toBeTrue();
    }
});

it('allows admin roles through middleware and redirects regular users', function () {
    registerAdminGateTestRoute();

    Role::findOrCreate(AdminRoles::WRITER);
    /** @var User $writer */
    $writer = User::factory()->create();
    $writer->assignRole(AdminRoles::WRITER);

    $this->actingAs($writer)
        ->get('/__test/admin-gate')
        ->assertOk();

    Role::findOrCreate(AdminRoles::USER);
    /** @var User $regularUser */
    $regularUser = User::factory()->create();
    $regularUser->assignRole(AdminRoles::USER);

    $this->actingAs($regularUser)
        ->get('/__test/admin-gate')
        ->assertRedirect('/');
});