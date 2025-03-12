<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    protected function getStats(): array
    {
        // dump('StatsOverview widget loaded'); // Debugging statement
        return [
            Stat::make('Total Users', \App\Models\User::count())
                ->description('Number of registered users')
                ->color('success'),
            Stat::make('Total Posts', \App\Models\Blog::count())
                ->description('Number of published posts')
                ->color('primary'),
            Stat::make('Total Events', \App\Models\Event::count())
                ->description('Number of completed events')
                ->color('warning'),
            Stat::make('Total Projects', \App\Models\Project::count())
                ->description('Number of completed projects')
                ->color('warning'),
            Stat::make('Total Sponsors', \App\Models\Sponsor::count())
                ->description('Active Sponsors')
                ->color('danger'),
        ];
    }
}
