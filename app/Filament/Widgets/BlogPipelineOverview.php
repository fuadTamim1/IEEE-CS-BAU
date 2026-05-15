<?php

namespace App\Filament\Widgets;

use App\Enums\BlogStatus;
use App\Models\Blog;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class BlogPipelineOverview extends BaseWidget
{
    protected ?string $heading = 'Content Pipeline';

    protected function getStats(): array
    {
        $counts = Cache::remember('dashboard:blog-pipeline:v1', now()->addMinutes(5), static function (): array {
            return Blog::query()
                ->selectRaw('status, COUNT(*) as aggregate')
                ->groupBy('status')
                ->pluck('aggregate', 'status')
                ->toArray();
        });

        $draft = (int) ($counts[BlogStatus::DRAFT->value] ?? 0);
        $pending = (int) ($counts[BlogStatus::PENDING_REVIEW->value] ?? 0);
        $rejected = (int) ($counts[BlogStatus::REJECTED->value] ?? 0);
        $published = (int) ($counts[BlogStatus::PUBLISHED->value] ?? 0);

        return [
            Stat::make(BlogStatus::DRAFT->label(), (string) $draft)
                ->description('Needs writing or revision')
                ->color(BlogStatus::DRAFT->color()),
            Stat::make(BlogStatus::PENDING_REVIEW->label(), (string) $pending)
                ->description('Waiting for moderation')
                ->color(BlogStatus::PENDING_REVIEW->color()),
            Stat::make(BlogStatus::REJECTED->label(), (string) $rejected)
                ->description('Needs author follow-up')
                ->color(BlogStatus::REJECTED->color()),
            Stat::make(BlogStatus::PUBLISHED->label(), (string) $published)
                ->description('Live on the website')
                ->color(BlogStatus::PUBLISHED->color()),
        ];
    }
}
