<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use App\Models\Event;
use App\Models\Project;
use App\Models\Sponsor;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class StatsOverview extends BaseWidget
{

    protected function getStats(): array
    {
        $metrics = Cache::remember('dashboard:stats-overview:v1', now()->addMinutes(5), static function (): array {
            return [
                'users' => User::query()->count(),
                'posts' => Blog::query()->count(),
                'events' => Event::query()->count(),
                'projects' => Project::query()->count(),
                'sponsors' => Sponsor::query()->count(),
            ];
        });

        return [
            Stat::make('Total Users', (string) $metrics['users'])
                ->description('Number of registered users')
                ->color('success'),
            Stat::make('Total Posts', (string) $metrics['posts'])
                ->description('Number of blog posts')
                ->color('primary'),
            Stat::make('Total Events', (string) $metrics['events'])
                ->description('Number of events')
                ->color('warning'),
            Stat::make('Total Projects', (string) $metrics['projects'])
                ->description('Number of projects')
                ->color('warning'),
            Stat::make('Total Sponsors', (string) $metrics['sponsors'])
                ->description('Active Sponsors')
                ->color('danger'),
        ];
    }
}
