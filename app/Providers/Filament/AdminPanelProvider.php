<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Settings;
use App\Filament\Pages\TextWidgets;
use App\Filament\Resources\BlogResource\Widgets\BlogPostCategoryChart;
use App\Filament\Resources\BlogResource\Widgets\RecentBlogPostsTable;
use App\Filament\Resources\LeaderboardResource;
use App\Filament\Resources\SubscriberResource;
use App\Filament\Resources\TextWidgetResource;
use App\Filament\Resources\UserResource\Widgets\UserGrowthChart;
use App\Filament\Widgets\StatsOverview;
use App\Http\Middleware\EnsureUserHasAdminAccess;
use App\Models\Subscriber;
use Chiiya\FilamentAccessControl\FilamentAccessControlPlugin;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Blade;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Hash;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('dashboard')
            // ->domain('admin.example.test')
            ->brandLogo("/images/IEEE-CS_LogoTM-orange.png")
            ->colors([
                'primary' => Color::Amber,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder
                    ->item(
                        NavigationItem::make('Visit Site')
                            ->url('/')
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
                        NavigationGroup::make('Users')
                            ->items([
                                NavigationItem::make('All Users')
                                    ->icon('heroicon-o-users')
                                    ->url('/admin/users'),
                                NavigationItem::make('Add New User')
                                    ->icon('heroicon-o-user-plus')
                                    ->url('/admin/users/create'),
                            ]),
                    )
                    ->group(
                        NavigationGroup::make('Content')
                            ->items([
                                NavigationItem::make('leaderboards')
                                    ->icon('heroicon-o-document-text')
                                    ->url(fn(): string => route('filament.admin.resources.leaderboards.index')),
                                NavigationItem::make('blogs')
                                    ->icon('heroicon-o-document-text')
                                    ->url('/admin/blogs')
                                    ->childItems([
                                        NavigationItem::make('All blogs')
                                            ->url('/admin/blogs'),
                                        NavigationItem::make('Add New Post')
                                            ->url('/admin/blogs/create'),
                                    ]),
                                NavigationItem::make('Projects')
                                    ->icon('heroicon-o-briefcase')
                                    ->url('/admin/projects')
                                    ->childItems([
                                        NavigationItem::make('All Projects')
                                            ->url('/admin/projects'),
                                        NavigationItem::make('Add New Project')
                                            ->url('/admin/projects/create'),
                                    ]),
                                NavigationItem::make('Members')
                                    ->icon('heroicon-o-users')
                                    ->url('/admin/members')
                                    ->childItems([
                                        NavigationItem::make('All Members')
                                            ->url('/admin/members'),
                                        NavigationItem::make('Add New Members')
                                            ->url('/admin/members/create'),
                                    ]),
                                NavigationItem::make('Events')
                                    ->icon('heroicon-o-calendar')
                                    ->url('/admin/events')
                                    ->group('Events & Sponsors')
                                    ->childItems([
                                        NavigationItem::make('All Events')
                                            ->url('/admin/events'),
                                        NavigationItem::make('Add New Event')
                                            ->url('/admin/events/create'),
                                    ]),

                                NavigationItem::make('Sponsors')
                                    ->icon('heroicon-o-calendar')
                                    ->url('/admin/sponsors')
                                    ->group('Events & Sponsors')
                                    ->childItems([
                                        NavigationItem::make('All Sponsors')
                                            ->url('/admin/sponsors'),
                                        NavigationItem::make('Add New Sponsor')
                                            ->url('/admin/sponsors/create'),
                                    ]),

                            ]),
                    )
                    ->group(
                        NavigationGroup::make('Mails')
                            ->items([
                                NavigationItem::make('Subscribers')
                                    ->icon('heroicon-o-envelope')
                                    ->url(fn(): string => SubscriberResource::getUrl())
                            ])
                    )
                    ->group(
                        NavigationGroup::make('Settings')
                            ->items([
                                NavigationItem::make('General Settings')
                                    ->icon('heroicon-o-cog')
                                    ->url(fn(): string => Settings::getUrl()),
                                // NavigationItem::make('Advanced Settings')
                                //     ->icon('heroicon-o-adjustments')
                                //     ->url('/admin/settings/advanced'),
                            ]),
                    );
            })
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->middleware([
                \Illuminate\Cookie\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\Session\Middleware\AuthenticateSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ])->widgets([
                StatsOverview::class,
                UserGrowthChart::class,
                RecentBlogPostsTable::class,
                BlogPostCategoryChart::class,

            ])
            ->authMiddleware([
                Authenticate::class,
                EnsureUserHasAdminAccess::class
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ]);
    }
}
