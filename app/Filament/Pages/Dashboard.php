<?php

namespace App\Filament\Pages;

use App\Filament\Resources\BlogResource;
use App\Filament\Resources\BlogResource\Widgets\BlogPostCategoryChart;
use App\Filament\Resources\BlogResource\Widgets\RecentBlogPostsTable;
use App\Filament\Resources\EventResource;
use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\WorkshopResource;
use App\Filament\Resources\UserResource\Widgets\UserGrowthChart;
use App\Filament\Widgets\BlogPipelineOverview;
use App\Filament\Widgets\ContestRegistrationsOverview;
use App\Filament\Widgets\ContestTeamSizeChart;
use App\Filament\Widgets\ExamSessionsOverview;
use App\Filament\Widgets\OperationsOverview;
use App\Filament\Widgets\RecentContestRegistrationsTable;
use App\Filament\Widgets\StatsOverview;
use Filament\Actions\Action;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            ContestRegistrationsOverview::class,
            BlogPipelineOverview::class,
            OperationsOverview::class,
            ExamSessionsOverview::class,
            UserGrowthChart::class,
            ContestTeamSizeChart::class,
            RecentContestRegistrationsTable::class,
            RecentBlogPostsTable::class,
            BlogPostCategoryChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createBlogPost')
                ->label('Create Blog Post')
                ->url(fn (): string => BlogResource::getUrl('create'))
                ->icon('heroicon-o-plus'),
            Action::make('addEvent')
                ->label('Add Event')
                ->url(fn (): string => EventResource::getUrl('create'))
                ->icon('heroicon-o-calendar'),
            Action::make('addProject')
                ->label('Add Project')
                ->url(fn (): string => ProjectResource::getUrl('create'))
                ->icon('heroicon-o-folder'),
            Action::make('addWorkshop')
                ->label('Add Workshop')
                ->url(fn (): string => WorkshopResource::getUrl('create'))
                ->icon('heroicon-o-wrench-screwdriver'),
            Action::make('openBcpcPage')
                ->label('Open BCPC Page')
                ->url(fn (): string => route('bcpc'))
                ->openUrlInNewTab()
                ->icon('heroicon-o-arrow-top-right-on-square'),
        ];
    }

    public function getColumns(): int | string | array
    {
        return [
            'md' => 2,
            'xl' => 3,
        ];
    }
}
