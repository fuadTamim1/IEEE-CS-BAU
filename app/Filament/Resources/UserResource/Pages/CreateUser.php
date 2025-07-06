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
        return $data;
    }

    protected function afterCreate(): void
    {
        if (isset($this->roleToAssign)) {
            $this->record->syncRoles([$this->roleToAssign]);
        }
    }
}
