<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tip;
use Illuminate\Auth\Access\HandlesAuthorization;

class TipPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isRoot) {
            return true;
        }
    }

    public function view(User $user, Tip $tip)
    {
    }

    public function create(User $user)
    {
        return $user->id > 0;
    }

    public function update(User $user, Tip $tip)
    {
    }

    public function delete(User $user, Tip $tip)
    {
    }
}
