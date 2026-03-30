<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any users.
     */
    public function viewAny(User $user): bool
    {
        return (bool) $user->is_admin;
    }

    public function ban(User $user, User $targetUser): bool
    {
        return (bool) $user->is_admin
            && $user->id !== $targetUser->id
            && !$targetUser->is_admin;
    }

    public function unban(User $user, User $targetUser): bool
    {
        return (bool) $user->is_admin
            && $user->id !== $targetUser->id
            && !$targetUser->is_admin;
    }
}
