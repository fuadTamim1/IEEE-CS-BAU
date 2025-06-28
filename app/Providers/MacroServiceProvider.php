<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Route as RouteObject;
class MacroServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::macro('underDevelopment', function (bool $enabled = false) {
            if ($enabled && $this instanceof RouteObject) {
                $this->middleware('under.development');
            }
            return $this;
        });
    }

       public function register(): void
    {
        // Leave empty or use only safe bindings — no 'files', etc.
    }
}
