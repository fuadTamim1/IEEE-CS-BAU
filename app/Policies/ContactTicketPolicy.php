<?php

namespace App\Policies;

use App\Models\ContactTicket;
use App\Models\User;

class ContactTicketPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->canManage($user);
    }

    public function view(User $user, ContactTicket $ticket): bool
    {
        return $this->canManage($user);
    }

    public function update(User $user, ContactTicket $ticket): bool
    {
        return $this->canManage($user);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function delete(User $user, ContactTicket $ticket): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    protected function canManage(User $user): bool
    {
        return $user->hasAnyRole(['super-admin', 'admin']);
    }
}
