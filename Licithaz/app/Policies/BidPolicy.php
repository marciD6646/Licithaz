<?php

namespace App\Policies;

use App\Models\User;

class BidPolicy
{
    public function create(User $user): bool
    {
        return true;
    }
}
