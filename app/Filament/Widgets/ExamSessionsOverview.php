<?php

namespace App\Filament\Widgets;

use App\Models\ExamSession;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class ExamSessionsOverview extends BaseWidget
{
    protected ?string $heading = 'Exam Sessions';

    protected function getStats(): array
    {
        $metrics = Cache::remember('dashboard:exam-sessions:v1', now()->addMinutes(5), static function (): array {
            $statusCounts = ExamSession::query()
                ->selectRaw('LOWER(status) as normalized_status, COUNT(*) as aggregate')
                ->groupBy('normalized_status')
                ->pluck('aggregate', 'normalized_status')
                ->toArray();

            $active = (int) ($statusCounts['active'] ?? 0)
                + (int) ($statusCounts['started'] ?? 0)
                + (int) ($statusCounts['in_progress'] ?? 0);

            $submitted = (int) ($statusCounts['submitted'] ?? 0)
                + (int) ($statusCounts['completed'] ?? 0);

            $expired = (int) ($statusCounts['expired'] ?? 0)
                + (int) ($statusCounts['timed_out'] ?? 0);

            $averageScore = (float) (ExamSession::query()->whereNotNull('score')->avg('score') ?? 0);

            return [
                'total' => ExamSession::query()->count(),
                'active' => $active,
                'submitted' => $submitted,
                'expired' => $expired,
                'average_score' => round($averageScore, 2),
            ];
        });

        return [
            Stat::make('Total Sessions', (string) $metrics['total'])
                ->description('All exam session records')
                ->color('primary'),
            Stat::make('Active Sessions', (string) $metrics['active'])
                ->description('Currently in progress')
                ->color('warning'),
            Stat::make('Submitted Sessions', (string) $metrics['submitted'])
                ->description("{$metrics['expired']} expired")
                ->color('success'),
            Stat::make('Average Score', (string) $metrics['average_score'])
                ->description('Across scored sessions')
                ->color('info'),
        ];
    }
}
