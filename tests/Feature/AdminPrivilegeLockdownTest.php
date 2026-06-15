<?php

use App\Filament\Pages\Settings;
use App\Filament\Resources\UserResource;
use App\Models\User;
use App\Support\AdminRoles;
use Spatie\Permission\Models\Role;

function makeLockdownUser(string $role): User
{
    Role::findOrCreate($role);

    /** @var User $user */
    $user = User::factory()->create();
    $user->assignRole($role);

    return $user;
}

it('allows only super admins to manage users in admin panel', function () {
    foreach (AdminRoles::superAdminRoles() as $role) {
        $user = makeLockdownUser($role);

        $this->actingAs($user);

        expect(UserResource::canViewAny())->toBeTrue();
        expect(UserResource::canCreate())->toBeTrue();
        expect(UserResource::canEdit($user))->toBeTrue();
        expect(UserResource::canDelete($user))->toBeTrue();
    }

    foreach ([AdminRoles::ADMIN, AdminRoles::EDITOR, AdminRoles::WRITER, AdminRoles::USER] as $role) {
        $user = makeLockdownUser($role);

        $this->actingAs($user);

        expect(UserResource::canViewAny())->toBeFalse();
        expect(UserResource::canCreate())->toBeFalse();
        expect(UserResource::canEdit($user))->toBeFalse();
        expect(UserResource::canDelete($user))->toBeFalse();
    }
});

it('allows only super admins to access settings page', function () {
    foreach (AdminRoles::superAdminRoles() as $role) {
        $user = makeLockdownUser($role);

        $this->actingAs($user);

        expect(Settings::canAccess())->toBeTrue();
    }

    foreach ([AdminRoles::ADMIN, AdminRoles::EDITOR, AdminRoles::WRITER, AdminRoles::USER] as $role) {
        $user = makeLockdownUser($role);

        $this->actingAs($user);

        expect(Settings::canAccess())->toBeFalse();
    }
});
