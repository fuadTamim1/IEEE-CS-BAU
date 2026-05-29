<?php

use App\Filament\Pages\BcpcMonitoring;
use App\Filament\Pages\Dashboard;
use App\Filament\Resources\BcpcRegistrationResource;
use App\Filament\Resources\EventResource;
use App\Filament\Resources\ExamCategoryResource;
use App\Filament\Resources\ExamResource;
use App\Filament\Resources\ExamSessionResource;
use App\Filament\Resources\ExamTaskResource;
use App\Filament\Resources\LeaderboardResource;
use App\Filament\Resources\MemberResource;
use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\SponsorResource;
use App\Filament\Resources\SubscriberResource;
use App\Filament\Resources\TextWidgetResource;
use App\Filament\Resources\WorkshopResource;
use App\Models\User;
use App\Support\AdminRoles;
use Spatie\Permission\Models\Role;

function makeMatrixUser(string $role): User
{
    Role::findOrCreate($role);

    /** @var User $user */
    $user = User::factory()->create();
    $user->assignRole($role);

    return $user;
}

function expectResourceReadWriteAccess(string $resourceClass, bool $allowed): void
{
    expect($resourceClass::canViewAny())->toBe($allowed);
    expect($resourceClass::canView(null))->toBe($allowed);
    expect($resourceClass::canCreate())->toBe($allowed);
    expect($resourceClass::canEdit(null))->toBe($allowed);
    expect($resourceClass::canDelete(null))->toBe($allowed);
    expect($resourceClass::canDeleteAny())->toBe($allowed);
}

it('allows moderation roles on content resources and blocks writer role', function () {
    $moderationResources = [
        EventResource::class,
        MemberResource::class,
        SponsorResource::class,
        LeaderboardResource::class,
        TextWidgetResource::class,
        ProjectResource::class,
        WorkshopResource::class,
    ];

    $editor = makeMatrixUser(AdminRoles::EDITOR);
    $this->actingAs($editor);

    foreach ($moderationResources as $resourceClass) {
        expectResourceReadWriteAccess($resourceClass, true);
    }

    $writer = makeMatrixUser(AdminRoles::WRITER);
    $this->actingAs($writer);

    foreach ($moderationResources as $resourceClass) {
        expectResourceReadWriteAccess($resourceClass, false);
    }
});

it('limits management resources to management roles and keeps bcpc registrations non-creatable', function () {
    $managementResources = [
        ExamResource::class,
        ExamSessionResource::class,
        ExamCategoryResource::class,
        ExamTaskResource::class,
        SubscriberResource::class,
    ];

    $admin = makeMatrixUser(AdminRoles::ADMIN);
    $this->actingAs($admin);

    foreach ($managementResources as $resourceClass) {
        expectResourceReadWriteAccess($resourceClass, true);
    }

    expect(BcpcRegistrationResource::canViewAny())->toBeTrue();
    expect(BcpcRegistrationResource::canView(null))->toBeTrue();
    expect(BcpcRegistrationResource::canEdit(null))->toBeTrue();
    expect(BcpcRegistrationResource::canCreate())->toBeFalse();
    expect(BcpcRegistrationResource::canDelete(null))->toBeFalse();
    expect(BcpcRegistrationResource::canDeleteAny())->toBeFalse();

    $editor = makeMatrixUser(AdminRoles::EDITOR);
    $this->actingAs($editor);

    foreach ($managementResources as $resourceClass) {
        expectResourceReadWriteAccess($resourceClass, false);
    }

    expect(BcpcRegistrationResource::canViewAny())->toBeFalse();
    expect(BcpcRegistrationResource::canView(null))->toBeFalse();
    expect(BcpcRegistrationResource::canEdit(null))->toBeFalse();
    expect(BcpcRegistrationResource::canCreate())->toBeFalse();
});

it('keeps dashboard open to admin roles while bcpc monitoring stays management-only', function () {
    $admin = makeMatrixUser(AdminRoles::ADMIN);
    $this->actingAs($admin);

    expect(Dashboard::canAccess())->toBeTrue();
    expect(BcpcMonitoring::canAccess())->toBeTrue();

    $writer = makeMatrixUser(AdminRoles::WRITER);
    $this->actingAs($writer);

    expect(Dashboard::canAccess())->toBeTrue();
    expect(BcpcMonitoring::canAccess())->toBeFalse();

    $regularUser = makeMatrixUser(AdminRoles::USER);
    $this->actingAs($regularUser);

    expect(Dashboard::canAccess())->toBeFalse();
    expect(BcpcMonitoring::canAccess())->toBeFalse();
});