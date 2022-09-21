<?php

namespace App\Policies;

use App\Models\Carro;
use App\Models\User;
use App\Facades\UserPermissions;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarroPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('carros.index');
    }

    public function view(User $user, Carro $carro)
    {
        return UserPermissions::isAuthorized('carros.show');
    }


    public function create(User $user)
    {
        return UserPermissions::isAuthorized('carros.create');
    }

    public function update(User $user)
    {
        return UserPermissions::isAuthorized('carros.edit');
    }

    public function delete(User $user, Carro $carro)
    {
        return UserPermissions::isAuthorized('carros.destroy');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Carro $carro)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Carro $carro)
    {
        //
    }
}
