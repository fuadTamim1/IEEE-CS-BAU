<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            // Add a custom link to the header
            Filament::registerRenderHook(
                'head.end',
                fn (): string => '<a href="/custom-link" class="bg-primary-500 text-white px-4 py-2 rounded-md">Custom Link</a>'
            );
        });
    }
}
