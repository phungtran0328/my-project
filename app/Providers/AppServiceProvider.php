<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\KindOfBook;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('header',function ($view){
            $categories = KindOfBook::all();
            $view->with('categories',$categories);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
