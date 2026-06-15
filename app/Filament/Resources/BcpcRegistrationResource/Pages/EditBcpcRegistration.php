<?php

namespace App\Filament\Resources\BcpcRegistrationResource\Pages;

use App\Filament\Resources\BcpcRegistrationResource;
use Filament\Resources\Pages\EditRecord;

class EditBcpcRegistration extends EditRecord
{
    protected static string $resource = BcpcRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
