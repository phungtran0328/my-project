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
        //khai báo biến $catagories được sử dụng ở header, vì header có ở mọi trang nên không gọi ở controller
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
