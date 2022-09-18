<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vagas;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Facades\UserPermissions;

class VagasPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('vagas.index');
    }

    public function view(User $user, Vagas $vagas)
    {
        return UserPermissions::isAuthorized('vagas.show');
    }


    public function create(User $user)
    {
        return UserPermissions::isAuthorized('vagas.create');
    }

    public function update(User $user, Vagas $vagas)
    {
        return UserPermissions::isAuthorized('vagas.edit');
    }

    public function delete(User $user, Vagas $vagas)
    {
        return UserPermissions::isAuthorized('vagas.destroy');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vagas  $vagas
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Vagas $vagas)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vagas  $vagas
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Vagas $vagas)
    {
        //
    }
}
