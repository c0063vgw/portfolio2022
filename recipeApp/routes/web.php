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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, "show"])->name('home');
Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::post('/store', 'RecipeListController@store')->name('store');
    Route::get('/edit', 'RecipeListController@edit')->name('edit');
    Route::post('/update/{id}', 'RecipeListController@update')->name('update');
    Route::get('/search', [App\Http\Controllers\RecipeListController::class, "show"])->name("search");
});
