<?php

namespace App\Filament\Widgets;

use App\Models\Bcpc\BcpcRegistration;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class ContestRegistrationsOverview extends BaseWidget
{
    protected ?string $heading = 'BCPC Teams';

    protected function getStats(): array
    {
        $metrics = Cache::remember('dashboard:contest-registrations:v1', now()->addMinutes(5), static function (): array {
            return [
                'total' => BcpcRegistration::query()->count(),
                'last_day' => BcpcRegistration::query()->where('created_at', '>=', now()->subDay())->count(),
                'team_size_2' => BcpcRegistration::query()->where('team_size', 2)->count(),
                'team_size_3' => BcpcRegistration::query()->where('team_size', 3)->count(),
            ];
        });

        return [
            Stat::make('Total Teams', (string) $metrics['total'])
                ->description('All BCPC team registrations')
                ->color('primary'),
            Stat::make('Last 24 Hours', (string) $metrics['last_day'])
                ->description('New submissions')
                ->color('success'),
            Stat::make('Teams of 2', (string) $metrics['team_size_2'])
                ->description('Duo teams')
                ->color('info'),
            Stat::make('Teams of 3', (string) $metrics['team_size_3'])
                ->description('Trio teams')
                ->color('warning'),
        ];
    }
}
