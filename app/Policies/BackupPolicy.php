<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/15/2018
 * Time: 11:44 AM
 */

namespace app\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BackupPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can create books.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['backup.create']);
    }

    /**
     * Determine whether the user can update the book.
     *
     * @param  \App\User  $user

     * @return mixed
     */
    public function download(User $user)
    {
        return $user->hasAccess(['backup.download']);
    }

    /**
     * Determine whether the user can delete the book.
     *
     * @param  \App\User  $user

     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasAccess(['backup.delete']);
    }
}