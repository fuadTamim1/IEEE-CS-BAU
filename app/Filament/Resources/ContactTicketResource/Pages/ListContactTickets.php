<?php

namespace App\Filament\Resources\ContactTicketResource\Pages;

use App\Filament\Resources\ContactTicketResource;
use Filament\Resources\Pages\ListRecords;

class ListContactTickets extends ListRecords
{
    protected static string $resource = ContactTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
