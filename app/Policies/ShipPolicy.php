<?php

namespace App\Policies;

use App\Models\Ship;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShipPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Ship $ship)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Ship $ship)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Ship $ship)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Ship $ship)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ship  $ship
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Ship $ship)
    {
        //
    }
}
