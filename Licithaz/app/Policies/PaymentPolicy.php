<?php

namespace App\Policies;

use App\Models\User;

class PaymentPolicy
{
    public function viewAny(User $user): bool
    {
        return (bool) $user->is_admin;
    }

}
