<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Filament\Facades\Filament;
use App\Policies\FilamentUserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Register model policies here if needed
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Filament::serving(function () {
            Filament::authorizeUsing([FilamentUserPolicy::class, 'access']);
        });
    }
}
