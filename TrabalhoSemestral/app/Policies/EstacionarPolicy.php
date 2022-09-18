<?php

namespace App\Policies;

use App\Models\Estacionar;
use App\Models\User;
use App\Facades\UserPermissions;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstacionarPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('estacionar.index');
    }

    public function view(User $user, Estacionar $estacionar)
    {
        return UserPermissions::isAuthorized('estacionar.show');
    }


    public function create(User $user)
    {
        return UserPermissions::isAuthorized('estacionar.create');
    }

    public function update(User $user, Estacionar $estacionar)
    {
        return UserPermissions::isAuthorized('estacionar.edit');
    }

    public function delete(User $user, Estacionar $estacionar)
    {
        return UserPermissions::isAuthorized('estacionar.destroy');
    }
    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estacionar  $estacionar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Estacionar $estacionar)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estacionar  $estacionar
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Estacionar $estacionar)
    {
        //
    }
}
