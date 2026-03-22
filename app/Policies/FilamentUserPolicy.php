<?php

namespace App\Policies;

use App\Models\User;

class FilamentUserPolicy
{
    public function access(User $user): bool
    {
        return $user->hasAnyRole(['super-admin', 'super_admin', 'admin', 'editor', 'writer']);
    }
}
