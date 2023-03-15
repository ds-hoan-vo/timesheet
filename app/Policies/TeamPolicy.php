<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function before($user, $ability): bool|null
    {
        if ($user->role === User::ADMIN) {
            return true;
        }
        return null;
    }
    public function viewAnyTeam(User $user)
    {
        //
        return $user->role === 'admin';
    }
    public function view(User $user, User $model)
    {
        //
        return $user->id === $model->id;
    }
    public function create(User $user)
    {
        //
        return $user->role === 'admin';
    }
    public function update(User $user, User $model)
    {
        //
        return $user->id === $model->id;
    }
    public function delete(User $user, User $model)
    {
        //
        return $user->id === $model->id;
    }

}
