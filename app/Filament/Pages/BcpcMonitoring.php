<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ContestRegistrationsOverview;
use App\Filament\Widgets\ContestTeamSizeChart;
use App\Filament\Widgets\RecentContestRegistrationsTable;
use App\Support\AdminRoles;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class BcpcMonitoring extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $title = 'BCPC Monitoring';

    protected static ?string $slug = 'bcpc-monitoring';

    protected static string $view = 'filament.pages.bcpc-monitoring';

    public static function canAccess(): bool
    {
        return Auth::user()?->hasAnyRole(AdminRoles::managementRoles()) ?? false;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ContestRegistrationsOverview::class,
            ContestTeamSizeChart::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            RecentContestRegistrationsTable::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | string | array
    {
        return [
            'md' => 2,
        ];
    }

    public function getFooterWidgetsColumns(): int | string | array
    {
        return 1;
    }
}
