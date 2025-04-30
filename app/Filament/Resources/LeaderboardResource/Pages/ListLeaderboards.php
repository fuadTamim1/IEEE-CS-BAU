<?php

namespace App\Filament\Resources\LeaderboardResource\Pages;

use App\Filament\Resources\LeaderboardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeaderboards extends ListRecords
{
    protected static string $resource = LeaderboardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
