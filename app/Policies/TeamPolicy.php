<?php

namespace App\Policies;

use App\Models\Team;
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
        $teams = $user->teams;
        if($teams->count() > 0){
            return true;
        }
        return false;
    }
    public function viewTeam(User $user, Team $model)
    {
        //
        $teamUsers = $model->hasUsers;
        foreach ($teamUsers as $teamUser) {
            if ($teamUser->pivot->role === Team::LEADER && $teamUser->pivot->user_id === $user->id) {
                return true;
            }
        }
        return false;

    }

    public function createTeam(User $user)
    {
        //
        return $user->role === User::ADMIN;
    }
    public function updateTeam(User $user, Team $model)
    {
        //
        $teamUsers = $model->hasUsers;
        foreach ($teamUsers as $teamUser) {
            if ($teamUser->pivot->role === Team::LEADER && $teamUser->pivot->user_id === $user->id) {
                return true;
            }
        }
        return false;
    }
    public function deleteTeam(User $user, Team $model)
    {
        //
        $teamUsers = $model->hasUsers;
        foreach ($teamUsers as $teamUser) {
            if ($teamUser->pivot->role === Team::LEADER && $teamUser->pivot->user_id === $user->id) {
                return true;
            }
        }
        return false;
    }

}