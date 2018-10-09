<?php

namespace App\Policies;

use App\User;
use App\CoverType;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoverTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the cover type.
     *
     * @param  \App\User  $user
     * @param  \App\CoverType  $coverType
     * @return mixed
     */
    public function view(User $user, CoverType $coverType)
    {
        //
    }

    /**
     * Determine whether the user can create cover types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the cover type.
     *
     * @param  \App\User  $user
     * @param  \App\CoverType  $coverType
     * @return mixed
     */
    public function update(User $user, CoverType $coverType)
    {
        //
    }

    /**
     * Determine whether the user can delete the cover type.
     *
     * @param  \App\User  $user
     * @param  \App\CoverType  $coverType
     * @return mixed
     */
    public function delete(User $user, CoverType $coverType)
    {
        //
    }

    /**
     * Determine whether the user can restore the cover type.
     *
     * @param  \App\User  $user
     * @param  \App\CoverType  $coverType
     * @return mixed
     */
    public function restore(User $user, CoverType $coverType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the cover type.
     *
     * @param  \App\User  $user
     * @param  \App\CoverType  $coverType
     * @return mixed
     */
    public function forceDelete(User $user, CoverType $coverType)
    {
        //
    }
}
