<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
//Route::get('/search', [App\Providers\AppServiceProvider::class, "boot"]);
Route::get('/home', [App\Http\Controllers\HomeController::class, "show"])->name('home');
Route::post('/store', 'RecipeListController@store')->name('store');
Route::get('/responce', 'RecipeListController@responce')->name('responce');
Route::get('/edit/{id}', 'RecipeListController@edit')->name('edit');
Route::post('/update', 'RecipeListController@update')->name('update');
Route::get('/similar/{id}', 'RecipeListController@similar')->name('similar');
Route::get('/compare/{id1}:{id2}', 'RecipeListController@compare')->name('compare');
Route::get('/search', [App\Http\Controllers\RecipeListController::class, "show"])->name("search");
