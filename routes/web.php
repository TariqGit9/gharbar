<?php

use Illuminate\Support\Facades\Route;

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
// Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/login', 'AdminController@login')->name('admin-login');
            Route::get('index', 'AdminController@index')->name('admin-index');
            Route::post('get-all-users', 'AdminController@getUsers')->name('admin-get-all-users');
    });
    Route::group(['prefix' => 'blogger'], function () {
        Route::get('/login', 'BloggerController@login')->name('blogger-login');
            Route::get('index', 'BloggerController@index')->name('blogger-index');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/login', 'UserController@login')->name('user-login');
            Route::get('index', 'UserController@index')->name('user-index');
    });
    Route::group(['prefix' => 'super-admin'], function () {
        Route::get('/login', 'SuperAdminController@login')->name('super-admin-login');
            Route::get('index', 'SuperAdminController@index')->name('super-admin-index');
            Route::post('get-all-users', 'SuperAdminController@getUsers')->name('super-admin-get-all-users');
    });
Route::get('/', function () {
    return view('index');
});
