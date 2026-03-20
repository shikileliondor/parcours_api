<?php

namespace App\Policies;

use App\Models\Ecole;
use App\Models\User;

class EcolePolicy
{
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Ecole $ecole): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Ecole $ecole): bool
    {
        return $user->isAdmin();
    }
}
