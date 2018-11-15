<?php

namespace App\Providers;

use App\Policies\BookPolicy;
use App\Policies\InvoiceInPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('invoice-in',InvoiceInPolicy::class);
        Gate::resource('book',BookPolicy::class);
        Gate::define('user.create','App\Policies\UserPolicy@create');
        Gate::define('user.update','App\Policies\UserPolicy@update');
        Gate::define('user.delete','App\Policies\UserPolicy@delete');

        Gate::define('customer.delete','App\Policies\CustomerPolicy@delete');

        Gate::define('order.update','App\Policies\OrderPolicy@update');
        Gate::define('order.delete','App\Policies\OrderPolicy@delete');
        Gate::define('invoice.delete','App\Policies\InvoicePolicy@delete');

        Gate::define('backup.create','App\Policies\BackupPolicy@create');
        Gate::define('backup.download','App\Policies\BackupPolicy@download');
        Gate::define('backup.delete','App\Policies\BackupPolicy@delete');
    }
}
