<?php

namespace App\Policies;

use App\User;
use App\ReleaseCompany;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReleaseCompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the release company.
     *
     * @param  \App\User  $user
     * @param  \App\ReleaseCompany  $releaseCompany
     * @return mixed
     */
    public function view(User $user, ReleaseCompany $releaseCompany)
    {
        //
    }

    /**
     * Determine whether the user can create release companies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['invoice-in.create']);
    }

    /**
     * Determine whether the user can update the release company.
     *
     * @param  \App\User  $user
     * @param  \App\ReleaseCompany  $releaseCompany
     * @return mixed
     */
    public function update(User $user, ReleaseCompany $releaseCompany)
    {
        //
    }

    /**
     * Determine whether the user can delete the release company.
     *
     * @param  \App\User  $user
     * @param  \App\ReleaseCompany  $releaseCompany
     * @return mixed
     */
    public function delete(User $user, ReleaseCompany $releaseCompany)
    {
        //
    }

    /**
     * Determine whether the user can restore the release company.
     *
     * @param  \App\User  $user
     * @param  \App\ReleaseCompany  $releaseCompany
     * @return mixed
     */
    public function restore(User $user, ReleaseCompany $releaseCompany)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the release company.
     *
     * @param  \App\User  $user
     * @param  \App\ReleaseCompany  $releaseCompany
     * @return mixed
     */
    public function forceDelete(User $user, ReleaseCompany $releaseCompany)
    {
        //
    }
}
