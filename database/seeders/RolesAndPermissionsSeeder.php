<?php


namespace Database\Seeders;

use App\Filament\Pages\BcpcMonitoring;
use App\Filament\Pages\Dashboard;
use App\Filament\Pages\Settings;
use App\Filament\Resources\BcpcRegistrationResource;
use App\Filament\Resources\BlogResource;
use App\Filament\Resources\ContactTicketResource;
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
use App\Filament\Resources\UserResource;
use App\Filament\Resources\BlogResource\Widgets\BlogPostCategoryChart;
use App\Filament\Resources\BlogResource\Widgets\RecentBlogPostsTable;
use App\Filament\Widgets\BlogPipelineOverview;
use App\Filament\Widgets\ContestRegistrationsOverview;
use App\Filament\Widgets\ContestTeamSizeChart;
use App\Filament\Widgets\ExamSessionsOverview;
use App\Filament\Widgets\OperationsOverview;
use App\Filament\Widgets\RecentContestRegistrationsTable;
use App\Filament\Widgets\StatsOverview;
use App\Support\AdminRoles;
use BezhanSalleh\FilamentShield\Resources\RoleResource;
use BezhanSalleh\FilamentShield\Facades\FilamentShield;
use Filament\Facades\Filament;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use RuntimeException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $panel = Filament::getPanel('admin');
        if (! $panel) {
            throw new RuntimeException('Filament panel "admin" is not available for Shield permission generation.');
        }

        Filament::setCurrentPanel($panel);

        $resourcePrefixes = config('filament-shield.permission_prefixes.resource', []);

        /** @var Collection<int, array{class: class-string, permission: string}> $pageDefinitions */
        $pageDefinitions = collect(FilamentShield::getPages())->values();
        /** @var Collection<int, array{class: class-string, permission: string}> $widgetDefinitions */
        $widgetDefinitions = collect(FilamentShield::getWidgets())->values();

        /** @var Collection<int, array{resource: string, model: string, fqcn: class-string}> $resourceDefinitions */
        $resourceDefinitions = collect(FilamentShield::getResources())->values();

        $resourcePermissionNames = $resourceDefinitions
            ->pluck('resource')
            ->filter()
            ->flatMap(
                fn(string $resourceKey): Collection => collect($resourcePrefixes)
                    ->map(fn(string $prefix): string => "{$prefix}_{$resourceKey}")
            )
            ->unique()
            ->values();

        $generatedPermissionNames = $resourcePermissionNames
            ->merge($pageDefinitions->pluck('permission'))
            ->merge($widgetDefinitions->pluck('permission'))
            ->filter()
            ->unique()
            ->values();

        $roleGuards = collect([
            config('auth.defaults.guard', 'web'),
            method_exists($panel, 'getAuthGuard') ? $panel->getAuthGuard() : null,
        ])
            ->merge(Permission::query()->pluck('guard_name'))
            ->filter()
            ->unique()
            ->values();

        $generatedPermissionNames->each(function (string $permissionName) use ($roleGuards): void {
            $roleGuards->each(
                fn(string $guard): Permission => Permission::findOrCreate($permissionName, $guard)
            );
        });

        $allPermissions = $generatedPermissionNames;

        $resourceKeyByClass = $resourceDefinitions
            ->mapWithKeys(fn(array $resource): array => [$resource['fqcn'] => $resource['resource']]);

        $contentResourceKeys = $resourceKeyByClass
            ->only([
                BlogResource::class,
                ProjectResource::class,
                WorkshopResource::class,
                EventResource::class,
                MemberResource::class,
                SponsorResource::class,
                LeaderboardResource::class,
                TextWidgetResource::class,
            ])
            ->values()
            ->all();

        $writerResourceKeys = $resourceKeyByClass
            ->only([
                BlogResource::class,
            ])
            ->values()
            ->all();

        $roleManagementResourceKeys = $resourceKeyByClass
            ->only([
                RoleResource::class,
            ])
            ->values()
            ->all();

        $roleManagementPermissions = $this->resourcePermissionNames(
            resourceKeys: $roleManagementResourceKeys,
            prefixes: $resourcePrefixes,
        );

        $settingsPagePermissions = $this->pagePermissionNames(
            pageDefinitions: $pageDefinitions,
            classes: [
                Settings::class,
            ],
        );

        $adminPermissions = $allPermissions
            ->diff($roleManagementPermissions)
            ->diff($settingsPagePermissions)
            ->values();

        $editorPermissions = collect($this->resourcePermissionNames(
            resourceKeys: $contentResourceKeys,
            prefixes: [
                'view_any',
                'view',
                'create',
                'update',
                'delete',
                'delete_any',
                'restore',
                'restore_any',
                'replicate',
                'reorder',
            ],
        ))
            ->merge($this->pagePermissionNames(
                pageDefinitions: $pageDefinitions,
                classes: [
                    Dashboard::class,
                    BcpcMonitoring::class,
                ],
            ))
            ->merge($this->widgetPermissionNames(
                widgetDefinitions: $widgetDefinitions,
                classes: [
                    StatsOverview::class,
                    BlogPipelineOverview::class,
                    RecentBlogPostsTable::class,
                    BlogPostCategoryChart::class,
                    OperationsOverview::class,
                    ContestRegistrationsOverview::class,
                    ContestTeamSizeChart::class,
                    RecentContestRegistrationsTable::class,
                    ExamSessionsOverview::class,
                ],
            ))
            ->unique()
            ->values();

        $writerPermissions = collect($this->resourcePermissionNames(
            resourceKeys: $writerResourceKeys,
            prefixes: [
                'view_any',
                'view',
                'create',
                'update',
            ],
        ))
            ->merge($this->pagePermissionNames(
                pageDefinitions: $pageDefinitions,
                classes: [
                    Dashboard::class,
                ],
            ))
            ->merge($this->widgetPermissionNames(
                widgetDefinitions: $widgetDefinitions,
                classes: [
                    BlogPipelineOverview::class,
                    RecentBlogPostsTable::class,
                ],
            ))
            ->unique()
            ->values();

        $roleGuards->each(function (string $guard) use ($adminPermissions, $editorPermissions, $writerPermissions): void {
            $permissionsForGuard = Permission::query()
                ->where('guard_name', $guard)
                ->pluck('name');

            $superAdmin = Role::findOrCreate(AdminRoles::SUPER_ADMIN, $guard);
            $admin = Role::findOrCreate(AdminRoles::ADMIN, $guard);
            $editor = Role::findOrCreate(AdminRoles::EDITOR, $guard);
            $writer = Role::findOrCreate(AdminRoles::WRITER, $guard);
            $user = Role::findOrCreate(AdminRoles::USER, $guard);

            $superAdmin->syncPermissions($permissionsForGuard);
            $admin->syncPermissions(collect($adminPermissions)->intersect($permissionsForGuard)->values());
            $editor->syncPermissions(collect($editorPermissions)->intersect($permissionsForGuard)->values());
            $writer->syncPermissions(collect($writerPermissions)->intersect($permissionsForGuard)->values());
            $user->syncPermissions([]);

            $legacySuperAdmin = Role::query()
                ->where('name', AdminRoles::LEGACY_SUPER_ADMIN)
                ->where('guard_name', $guard)
                ->first();

            if ($legacySuperAdmin) {
                $legacySuperAdmin->syncPermissions($permissionsForGuard);
            }
        });

        Permission::query()
            ->whereIn('name', [
                'edit articles',
                'delete articles',
                'publish articles',
                'unpublish articles',
            ])
            ->delete();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    /**
     * @param  array<int, string>  $resourceKeys
     * @param  array<int, string>  $prefixes
     * @return array<int, string>
     */
    private function resourcePermissionNames(array $resourceKeys, array $prefixes): array
    {
        return collect($resourceKeys)
            ->filter()
            ->flatMap(
                fn(string $resourceKey): Collection => collect($prefixes)
                    ->map(fn(string $prefix): string => "{$prefix}_{$resourceKey}")
            )
            ->unique()
            ->values()
            ->all();
    }

    /**
     * @param  Collection<int, array{class: class-string, permission: string}>  $pageDefinitions
     * @param  array<int, class-string>  $classes
     * @return array<int, string>
     */
    private function pagePermissionNames(Collection $pageDefinitions, array $classes): array
    {
        return $pageDefinitions
            ->filter(fn(array $page): bool => in_array($page['class'], $classes, true))
            ->pluck('permission')
            ->values()
            ->all();
    }

    /**
     * @param  Collection<int, array{class: class-string, permission: string}>  $widgetDefinitions
     * @param  array<int, class-string>  $classes
     * @return array<int, string>
     */
    private function widgetPermissionNames(Collection $widgetDefinitions, array $classes): array
    {
        return $widgetDefinitions
            ->filter(fn(array $widget): bool => in_array($widget['class'], $classes, true))
            ->pluck('permission')
            ->values()
            ->all();
    }
}
