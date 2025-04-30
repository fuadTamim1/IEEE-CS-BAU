<?php

namespace App\Providers;

use App\Models\Blog;
use App\Observers\BlogObserver;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blog::observe(BlogObserver::class);
    }
}
