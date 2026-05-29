<?php

namespace App\Policies;

use App\Models\User;
use App\Support\AdminRoles;

class FilamentUserPolicy
{
    public function access(User $user): bool
    {
        return $user->hasAnyRole(AdminRoles::adminAccessRoles());
    }
}
