<?php

namespace App\Filament\Widgets;

use App\Enums\ContactTicketStatus;
use App\Models\ContactTicket;
use App\Models\Event;
use App\Models\Subscriber;
use App\Models\Workshop;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class OperationsOverview extends BaseWidget
{
    protected ?string $heading = 'Operations Pulse';

    protected function getStats(): array
    {
        $metrics = Cache::remember('dashboard:operations-overview:v1', now()->addMinutes(5), static function (): array {
            $now = now();

            return [
                'events_upcoming' => Event::query()
                    ->whereNotNull('start_at')
                    ->where('start_at', '>', $now)
                    ->count(),
                'events_ongoing' => Event::query()
                    ->whereNotNull('start_at')
                    ->whereNotNull('end_at')
                    ->where('start_at', '<=', $now)
                    ->where('end_at', '>=', $now)
                    ->count(),
                'workshops_upcoming' => Workshop::query()
                    ->whereNotNull('start_at')
                    ->where('start_at', '>', $now)
                    ->count(),
                'workshops_ongoing' => Workshop::query()
                    ->whereNotNull('start_at')
                    ->whereNotNull('end_at')
                    ->where('start_at', '<=', $now)
                    ->where('end_at', '>=', $now)
                    ->count(),
                'tickets_open' => ContactTicket::query()
                    ->where('status', ContactTicketStatus::OPEN->value)
                    ->count(),
                'tickets_closed' => ContactTicket::query()
                    ->where('status', ContactTicketStatus::CLOSED->value)
                    ->count(),
                'subscribers_total' => Subscriber::query()->count(),
                'subscribers_last_30_days' => Subscriber::query()
                    ->where('created_at', '>=', now()->subDays(30))
                    ->count(),
            ];
        });

        return [
            Stat::make('Events', (string) ($metrics['events_upcoming'] + $metrics['events_ongoing']))
                ->description("{$metrics['events_upcoming']} upcoming / {$metrics['events_ongoing']} ongoing")
                ->color('warning'),
            Stat::make('Workshops', (string) ($metrics['workshops_upcoming'] + $metrics['workshops_ongoing']))
                ->description("{$metrics['workshops_upcoming']} upcoming / {$metrics['workshops_ongoing']} ongoing")
                ->color('info'),
            Stat::make('Support Tickets', (string) $metrics['tickets_open'])
                ->description("{$metrics['tickets_closed']} closed")
                ->color('danger'),
            Stat::make('Subscribers', (string) $metrics['subscribers_total'])
                ->description("{$metrics['subscribers_last_30_days']} joined in 30 days")
                ->color('success'),
        ];
    }
}
