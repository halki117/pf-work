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


Route::get('spots/searching', 'SpotsController@searching')->name('spots.searching');
Route::post('spots/searched', 'SpotsController@searched')->name('spots.searched');
Route::get('spots/favorites', 'SpotsController@favorites')->name('spots.favorites');
Route::resource('spots', 'SpotsController')->middleware('verified');


Route::resource('users', 'usersController');

Route::resource('comments', 'commentsController');

Route::prefix('spots')->name('spots.')->group(function () {
    Route::put('/{spots}/like', 'SpotsController@like')->name('like')->middleware('auth');
    Route::delete('/{spots}/like', 'SpotsController@unlike')->name('unlike')->middleware('auth');
});

Route::get('/tags/{name}', 'TagsController@show')->name('tags.show');


Route::get('notifications', 'NotificationsController@index')->name('notifications.index');
Route::get('notifications/{id}', 'NotificationsController@checked')->name('notifications.checked');
Route::get('notifications/announce/{id}', 'NotificationsController@announce')->name('notifications.announce');


Route::group(['middleware' => ['can:admin']], function(){
    Route::get('admin/users', 'admin\UsersController@index')->name('admin.users.index');
    Route::get('admin/users/{id}', 'admin\UsersController@show')->name('admin.users.show');
    Route::get('admin/spots', 'admin\SpotsController@index')->name('admin.spots.index');
    Route::get('admin/spots/{id}', 'admin\SpotsController@show')->name('admin.spots.show');
    Route::get('admin/announcements', 'admin\AnnouncementsController@index')->name('admin.announcements.index');
    Route::get('admin/announcements/create', 'admin\AnnouncementsController@create')->name('admin.announcements.create');
    Route::post('admin/announcements', 'admin\AnnouncementsController@store')->name('admin.announcements.store');
    Route::get('admin/announcements/{id}', 'admin\AnnouncementsController@show')->name('admin.announcements.show');
});