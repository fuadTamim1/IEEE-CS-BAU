<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set the author_id to the currently logged-in user's ID
        $data['author_id'] = Auth::id();
        // $data['tags'] = "'" . implode(',', $data['tags']) . "'";

        return $data;
    }
}
