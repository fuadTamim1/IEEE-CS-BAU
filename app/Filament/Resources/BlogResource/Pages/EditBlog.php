<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Enums\BlogStatus;
use App\Filament\Resources\BlogResource;
use App\Support\AdminRoles;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditBlog extends EditRecord
{
    protected static string $resource = BlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $isModerator = Auth::user()?->hasAnyRole(AdminRoles::moderationRoles()) ?? false;

        if (!$isModerator) {
            unset($data['status']);
            unset($data['rejection_note']);

            if ($this->record->status === BlogStatus::REJECTED->value) {
                $data['status'] = BlogStatus::PENDING_REVIEW->value;
                $data['submitted_at'] = now();
                $data['reviewed_by'] = null;
                $data['reviewed_at'] = null;
            }
        }

        return $data;
    }
}
