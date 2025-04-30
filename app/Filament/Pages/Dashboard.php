<?php

namespace App\Filament\Pages;

use App\Filament\Resources\BlogResource;
use App\Filament\Resources\BlogResource\Widgets\BlogPostCategoryChart;
use App\Filament\Resources\BlogResource\Widgets\RecentBlogPostsTable;
use App\Filament\Resources\EventResource;
use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\UserResource\Widgets\UserGrowthChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            UserGrowthChart::class,
            RecentBlogPostsTable::class,
            BlogPostCategoryChart::class
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('createBlogPost')
                ->label('Create Blog Post')
                ->url(fn(): string => BlogResource::getUrl() . "/create")
                ->icon('heroicon-o-plus'),
            \Filament\Actions\Action::make('addEvent')
                ->label('Add Event')
                ->url(fn(): string => EventResource::getUrl() . "/create")
                ->icon('heroicon-o-calendar'),
            \Filament\Actions\Action::make('addProject')
                ->label('Add Project')
                ->url(fn(): string => ProjectResource::getUrl() . "/create")
                ->icon('heroicon-o-folder'),
        ];
    }

    protected function getColumns(): int | array
    {
        return 1; // 2-column layout
    }

    // public static function canAccess() :bool {
    //     return auth()->user()?->hasAnyRole(['super-admin', 'admin', 'editor', 'writer']) ?? false;
    // }
}
