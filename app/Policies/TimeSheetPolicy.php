<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\TimeSheet;
use App\Models\User;

class TimeSheetPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability): bool|null
    {
        if ($user->role === 'admin') {
            return true;
        }
        return null;
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAnyTimeSheet(User $user)
    {
        //
        if($user->role === 'admin'){
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TimeSheet  $timeSheet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewTimeSheet(User $user, TimeSheet $timeSheet)
    {
        //
        return $user->id === $timeSheet->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function createTimeSheet(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TimeSheet  $timeSheet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateTimeSheet(User $user, TimeSheet $timeSheet)
    {
        //
        return $user->id === $timeSheet->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TimeSheet  $timeSheet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteTimeSheet(User $user, TimeSheet $timeSheet)
    {
        //
        return $user->role === 'admin';
    }
}
