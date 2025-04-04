<?php

namespace App\Filament\Resources\TextWidgetResource\Pages;

use App\Filament\Resources\TextWidgetResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;

class ViewTextWidget extends ViewRecord
{
    protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
