<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    private $roleToAssign;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $role = $data['role'] ?? 'user';
        unset($data['role']);
        $this->roleToAssign = $role;

        $approvalStatus = $data['approval_status'] ?? 'approved';
        $data['approval_status'] = $approvalStatus;
        $data['approved_at'] = $approvalStatus === 'approved' ? now() : null;
        $data['password_changed_at'] = now();

        return $data;
    }

    protected function afterCreate(): void
    {
        if (isset($this->roleToAssign)) {
            $this->record->syncRoles([$this->roleToAssign]);
        }
    }
}
