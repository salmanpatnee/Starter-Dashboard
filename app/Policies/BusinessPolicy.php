<?php

namespace App\Policies;

use App\Models\Business;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Permissions\Permission;

class BusinessPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can(Permission::CAN_VIEW_SETTINGS);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Business $business)
    {
        return $user->can(Permission::CAN_VIEW_SETTINGS);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Business  $business
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Business $business)
    {
        return $user->can(Permission::CAN_UPDATE_SETTINGS);
    }
}
