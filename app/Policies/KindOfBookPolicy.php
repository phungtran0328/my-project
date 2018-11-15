<?php

namespace App\Policies;

use App\User;
use App\KindOfBook;
use Illuminate\Auth\Access\HandlesAuthorization;

class KindOfBookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the kind of book.
     *
     * @param  \App\User  $user
     * @param  \App\KindOfBook  $kindOfBook
     * @return mixed
     */
    public function view(User $user, KindOfBook $kindOfBook)
    {
        //
    }

    /**
     * Determine whether the user can create kind of books.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['book.create']);
    }

    /**
     * Determine whether the user can update the kind of book.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasAccess(['book.update']);
    }

    /**
     * Determine whether the user can delete the kind of book.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasAccess(['book.delete']);
    }

    /**
     * Determine whether the user can restore the kind of book.
     *
     * @param  \App\User  $user
     * @param  \App\KindOfBook  $kindOfBook
     * @return mixed
     */
    public function restore(User $user, KindOfBook $kindOfBook)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the kind of book.
     *
     * @param  \App\User  $user
     * @param  \App\KindOfBook  $kindOfBook
     * @return mixed
     */
    public function forceDelete(User $user, KindOfBook $kindOfBook)
    {
        //
    }
}
