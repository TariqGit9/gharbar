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
        Route::post('/login', 'AdminController@authenticate')->name('admin-authenticate');
        Route::group(['middleware' => 'admin'], function () {
            Route::get('index', 'AdminController@index')->name('admin-index');
            Route::post('get-all-users', 'AdminController@getUsers')->name('get-all-users');
            
        });
    });
    Route::group(['prefix' => 'blogger'], function () {
        Route::get('/login', 'BloggerController@login')->name('blogger-login');
        Route::post('/login', 'BloggerController@authenticate')->name('blogger-authenticate');
        Route::group(['middleware' => 'blogger'], function () {
            Route::get('blogger-index', 'BloggerController@index')->name('blogger-index');
        });
    });
    Route::group(['prefix' => 'user'], function () {
        Route::group(['middleware' => 'user'], function () {
            Route::get('user-index', 'UserController@index')->name('user-index');
        });
    });
    Route::group(['prefix' => 'super-admin'], function () {
        Route::get('/login', 'SuperAdminController@login')->name('super-admin-login');
        // Route::post('/login', 'SuperAdminController@authenticate')->name('super-admin-authenticate');
        Route::group(['middleware' => 'super_admin'], function () {
            Route::get('super-admin-index', 'SuperAdminController@index')->name('super-admin-index');
        });
    });
// });
Auth::routes();
Route::get('/', function () {
    return view('index');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
