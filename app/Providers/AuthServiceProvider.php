<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\ContactTicket;
use App\Policies\BlogPolicy;
use App\Policies\ContactTicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Filament\Facades\Filament;
use App\Policies\FilamentUserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Blog::class => BlogPolicy::class,
        ContactTicket::class => ContactTicketPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Filament::serving(function () {
            Filament::authorizeUsing([FilamentUserPolicy::class, 'access']);
        });
    }
}
