<?php
/**
 * Created by PhpStorm.
 * User: PHUNGTRAN
 * Date: 11/15/2018
 * Time: 12:09 PM
 */

namespace app\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the invoice in.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasAccess(['invoice.delete']);
    }
}