<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Super admin
Route::group(['prefix' => 'super-admin'], function () {
    Route::post('/login', 'SuperAdminController@authenticate')->name('super-admin-authenticate');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('super-admin-delete-user', 'SuperAdminController@deleteUser')->name('super-admin-delete-user');
        Route::post('edit-user', 'SuperAdminController@editUser')->name('super-admin-edit-user');
        Route::post('add-user', 'SuperAdminController@addUser')->name('super-admin-add-user');
    });

});
//User
Route::group(['prefix' => 'user'], function () {
    Route::post('/login', 'UserController@authenticate')->name('user-authenticate');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('delete-user', 'UserController@deleteUser')->name('user-delete-user');
        Route::post('edit-user', 'UserController@editUser')->name('user-edit-user');
        Route::post('add-user', 'UserController@addUser')->name('user-add-user');
    });

});

//Admin
Route::group(['prefix' => 'admin'], function () {
    Route::post('/login', 'AdminController@authenticate')->name('admin-authenticate');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('delete-user', 'AdminController@deleteUser')->name('admin-delete-user');
        Route::post('edit-user', 'AdminController@editUser')->name('admin-edit-user');
        Route::post('add-user', 'SuperAdminController@addUser')->name('admin-add-user');

    });

});
//Blogger
Route::group(['prefix' => 'blogger'], function () {
    Route::post('/login', 'BloggerController@authenticate')->name('blogger-authenticate');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('get-blogs', 'BloggerController@myBlogs')->name('get-blogs');
        Route::post('add-blogs', 'BloggerController@addBlogs')->name('add-blogs');
    });

});