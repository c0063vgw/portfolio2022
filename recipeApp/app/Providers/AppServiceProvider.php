<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use App\Genre;
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
            $user = \Auth::user();
             // インスタンス化
            $genreModel = new Genre();
            $genre_list = $genreModel->Genres();
            
            $view->with('genre_list', $genre_list)->with('user', $user);
        });
    }
}
