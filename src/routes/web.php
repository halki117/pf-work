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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::resource('spots', 'SpotsController')->middleware('verified');

Route::resource('users', 'usersController');

Route::resource('comments', 'commentsController');

Route::prefix('spots')->name('spots.')->group(function () {
    Route::put('/{spots}/like', 'SpotsController@like')->name('like')->middleware('auth');
    Route::delete('/{spots}/like', 'SpotsController@unlike')->name('unlike')->middleware('auth');
});