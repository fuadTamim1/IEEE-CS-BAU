<?php

namespace App\Filament\Widgets;

use App\Models\Bcpc\BcpcRegistration;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentContestRegistrationsTable extends BaseWidget
{
    protected static ?string $heading = 'Latest BCPC Team Registrations';

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return BcpcRegistration::query()->latest()->limit(8);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('team_name')
                ->label('Team')
                ->formatStateUsing(fn (?string $state, BcpcRegistration $record): string => $state ?: ($record->full_name ?: 'N/A'))
                ->searchable()
                ->limit(24),
            Tables\Columns\TextColumn::make('captain_name')
                ->label('Captain')
                ->formatStateUsing(fn (?string $state, BcpcRegistration $record): string => $state ?: ($record->full_name ?: 'N/A'))
                ->limit(22),
            Tables\Columns\TextColumn::make('team_size')
                ->label('Size')
                ->badge()
                ->formatStateUsing(fn ($state): string => filled($state) ? (string) $state : '-')
                ->color(fn ($state): string => (int) $state === 3 ? 'info' : 'primary'),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'approved' => 'success',
                    'rejected' => 'danger',
                    'submitted' => 'warning',
                    default => 'gray',
                }),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Submitted')
                ->since(),
        ];
    }
}
