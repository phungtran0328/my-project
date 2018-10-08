<?php

namespace App\Policies;

use App\User;
use App\InvoiceIn;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoiceInPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the invoice in.
     *
     * @param  \App\User  $user
     * @param  \App\InvoiceIn  $invoiceIn
     * @return mixed
     */
    public function view(User $user, InvoiceIn $invoiceIn)
    {
        //
    }

    /**
     * Determine whether the user can create invoice ins.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['invoice-in.create']);
    }

    /**
     * Determine whether the user can update the invoice in.
     *
     * @param  \App\User  $user
     * @param  \App\InvoiceIn  $invoiceIn
     * @return mixed
     */
    public function update(User $user, InvoiceIn $invoiceIn)
    {
        return $user->hasAccess(['invoice-in.update']) or $user->NV_MA==$invoiceIn->NV_MA;
    }

    /**
     * Determine whether the user can delete the invoice in.
     *
     * @param  \App\User  $user
     * @param  \App\InvoiceIn  $invoiceIn
     * @return mixed
     */
    public function delete(User $user, InvoiceIn $invoiceIn)
    {
        //
    }

    /**
     * Determine whether the user can restore the invoice in.
     *
     * @param  \App\User  $user
     * @param  \App\InvoiceIn  $invoiceIn
     * @return mixed
     */
    public function restore(User $user, InvoiceIn $invoiceIn)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the invoice in.
     *
     * @param  \App\User  $user
     * @param  \App\InvoiceIn  $invoiceIn
     * @return mixed
     */
    public function forceDelete(User $user, InvoiceIn $invoiceIn)
    {
        //
    }
}
