<?php

namespace App\Policies;

use App\Enums\BlogStatus;
use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super-admin', 'admin', 'editor', 'writer']);
    }

    public function view(User $user, Blog $blog): bool
    {
        if ($this->canModerate($user)) {
            return true;
        }

        return (int) $blog->author_id === (int) $user->id;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super-admin', 'admin', 'editor', 'writer']);
    }

    public function update(User $user, Blog $blog): bool
    {
        if ($this->canModerate($user)) {
            return true;
        }

        if ((int) $blog->author_id !== (int) $user->id) {
            return false;
        }

        return in_array($blog->status, [
            BlogStatus::DRAFT->value,
            BlogStatus::REJECTED->value,
        ], true);
    }

    public function delete(User $user, Blog $blog): bool
    {
        if ($this->canModerate($user)) {
            return true;
        }

        return (int) $blog->author_id === (int) $user->id
            && in_array($blog->status, [
                BlogStatus::DRAFT->value,
                BlogStatus::REJECTED->value,
            ], true);
    }

    public function deleteAny(User $user): bool
    {
        return $this->canModerate($user);
    }

    public function forceDelete(User $user, Blog $blog): bool
    {
        return $this->canModerate($user);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $this->canModerate($user);
    }

    public function restore(User $user, Blog $blog): bool
    {
        return $this->canModerate($user);
    }

    public function restoreAny(User $user): bool
    {
        return $this->canModerate($user);
    }

    public function replicate(User $user, Blog $blog): bool
    {
        return $this->canModerate($user);
    }

    public function reorder(User $user): bool
    {
        return $this->canModerate($user);
    }

    protected function canModerate(User $user): bool
    {
        return $user->hasAnyRole(['super-admin', 'admin', 'editor']);
    }
}
