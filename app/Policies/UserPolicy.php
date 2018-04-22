<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->isRoot;
    }

    public function view(User $user)
    {
    }

    public function create(User $user)
    {
        return $user->id > 0;
    }

    public function update(User $user)
    {
    }

    public function delete(User $user)
    {
    }
}
