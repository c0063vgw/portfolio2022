<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //特定ののメソッドが呼ばれる前に先に呼ばれるメソッド
        view()->composer('*', function ($view) {
            // get the current user
            $user = \Auth::user();
            
            $view->with('user', $user);
        });
    }
}
