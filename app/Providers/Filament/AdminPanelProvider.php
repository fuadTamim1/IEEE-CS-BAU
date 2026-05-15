<?php

namespace App\Providers\Filament;

use App\Filament\Pages\BcpcMonitoring;
use App\Filament\Pages\Dashboard;
use App\Filament\Pages\Settings;
use App\Filament\Resources\BcpcRegistrationResource;
use App\Filament\Resources\BlogResource;
use App\Filament\Resources\ContactTicketResource;
use App\Filament\Resources\EventResource;
use App\Filament\Resources\ExamResource;
use App\Filament\Resources\ExamSessionResource;
use App\Filament\Resources\LeaderboardResource;
use App\Filament\Resources\MemberResource;
use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\SponsorResource;
use App\Filament\Resources\SubscriberResource;
use App\Filament\Resources\TextWidgetResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\WorkshopResource;
use App\Http\Middleware\EnsureUserHasAdminAccess;
use Filament\Http\Middleware\Authenticate;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            // ->domain('admin.example.test')
            ->brandLogo("/images/IEEE-CS_LogoTM-orange.png")
            ->colors([
                'primary' => Color::Amber,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder
                    ->item(
                        NavigationItem::make('Visit Site')
                            ->url(url('/'))
                            ->icon('heroicon-o-arrow-top-right-on-square')
                            ->openUrlInNewTab(),
                    )
                    ->item(
                        NavigationItem::make('Dashboard')
                            ->icon('heroicon-o-home')
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.pages.dashboard'))
                            ->url(fn(): string => Dashboard::getUrl()),
                    )
                    ->item(
                        NavigationItem::make('Text Widgets')
                            ->icon('heroicon-o-document-text')
                            ->url(fn(): string => TextWidgetResource::getUrl())
                            ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.text-widgets.*')),
                    )
                    ->group(
                        NavigationGroup::make('BCPC')
                            ->items([
                                NavigationItem::make('Registrations Table')
                                    ->icon('heroicon-o-table-cells')
                                    ->url(fn (): string => BcpcRegistrationResource::getUrl()),
                                NavigationItem::make('Monitoring')
                                    ->icon('heroicon-o-presentation-chart-line')
                                    ->url(fn (): string => BcpcMonitoring::getUrl()),
                            ]),
                    )
                    ->group(
                        NavigationGroup::make('Users')
                            ->items([
                                NavigationItem::make('Users')
                                    ->icon('heroicon-o-users')
                                    ->url(fn (): string => UserResource::getUrl()),
                                NavigationItem::make('Add User')
                                    ->icon('heroicon-o-user-plus')
                                    ->url(fn (): string => UserResource::getUrl('create')),
                            ]),
                    )
                    ->group(
                        NavigationGroup::make('Content')
                            ->items([
                                NavigationItem::make('Leaderboards')
                                    ->icon('heroicon-o-trophy')
                                    ->url(fn (): string => LeaderboardResource::getUrl()),
                                NavigationItem::make('Blogs')
                                    ->icon('heroicon-o-document-text')
                                    ->url(fn (): string => BlogResource::getUrl()),
                                NavigationItem::make('Projects')
                                    ->icon('heroicon-o-briefcase')
                                    ->url(fn (): string => ProjectResource::getUrl()),
                                NavigationItem::make('Workshops')
                                    ->icon('heroicon-o-wrench-screwdriver')
                                    ->url(fn (): string => WorkshopResource::getUrl()),
                                NavigationItem::make('Members')
                                    ->icon('heroicon-o-users')
                                    ->url(fn (): string => MemberResource::getUrl()),
                                NavigationItem::make('Events')
                                    ->icon('heroicon-o-calendar')
                                    ->url(fn (): string => EventResource::getUrl()),
                                NavigationItem::make('Sponsors')
                                    ->icon('heroicon-o-building-office-2')
                                    ->url(fn (): string => SponsorResource::getUrl()),
                            ]),
                    )
                    ->group(
                        NavigationGroup::make('Exams')
                            ->items([
                                NavigationItem::make('Exams')
                                    ->icon('heroicon-o-academic-cap')
                                    ->url(fn (): string => ExamResource::getUrl()),
                                NavigationItem::make('Sessions')
                                    ->icon('heroicon-o-clipboard-document-list')
                                    ->url(fn (): string => ExamSessionResource::getUrl()),
                            ]),
                    )
                    ->group(
                        NavigationGroup::make('Mails')
                            ->items([
                                NavigationItem::make('Contact Tickets')
                                    ->icon('heroicon-o-inbox-stack')
                                    ->url(fn (): string => ContactTicketResource::getUrl()),
                                NavigationItem::make('Subscribers')
                                    ->icon('heroicon-o-envelope')
                                    ->url(fn (): string => SubscriberResource::getUrl()),
                            ]),
                    )
                    ->group(
                        NavigationGroup::make('Settings')
                            ->items([
                                NavigationItem::make('General Settings')
                                    ->icon('heroicon-o-cog')
                                    ->url(fn (): string => Settings::getUrl()),
                            ]),
                    );
            })
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->middleware([
                \Illuminate\Cookie\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\Session\Middleware\AuthenticateSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                EnsureUserHasAdminAccess::class,
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ]);
    }
}
