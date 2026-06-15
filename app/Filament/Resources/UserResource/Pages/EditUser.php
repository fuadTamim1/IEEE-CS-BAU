<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    private $roleToAssign;
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $role = $data['role'] ?? 'user';
        unset($data['role']);
        $this->roleToAssign = $role;

        $approvalStatus = $data['approval_status'] ?? ($this->record->approval_status ?? 'approved');
        $data['approval_status'] = $approvalStatus;
        $data['approved_at'] = $approvalStatus === 'approved' ? ($this->record->approved_at ?? now()) : null;

        return $data;
    }

    protected function afterSave(): void
    {
        if (isset($this->roleToAssign)) {
            $this->record->syncRoles([$this->roleToAssign]);
        }
    }
}
