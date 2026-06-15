<?php

namespace App\Filament\Resources\BcpcRegistrationResource\Pages;

use App\Filament\Resources\BcpcRegistrationResource;
use Filament\Resources\Pages\ListRecords;

class ListBcpcRegistrations extends ListRecords
{
    protected static string $resource = BcpcRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
