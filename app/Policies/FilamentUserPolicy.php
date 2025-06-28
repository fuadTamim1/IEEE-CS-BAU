<?php

namespace App\Policies;

use App\Models\User;

class FilamentUserPolicy
{
    public function access(User $user): bool
    {
        return $user->hasRole('admin'); // or 'super admin' if that’s your role
    }
}
