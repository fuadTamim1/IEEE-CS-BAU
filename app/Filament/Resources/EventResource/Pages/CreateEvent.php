<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Container\Attributes\Auth;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $now = Carbon::now();
        // Set the author_id to the currently logged-in user's ID
        if($now < Carbon::parse($data['start_at'])){
            $data['status'] = "upcoming";
        }
        if($now > Carbon::parse($data['end_at'])){
            $data['status'] = "completed";
        }
        if($now > Carbon::parse($data['start_at']) && $now < Carbon::parse($data['end_at']) ){
            $data['status'] = "ongoing";
        }
        return $data;
    }
}
