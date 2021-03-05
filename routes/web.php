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

Route::get('login', 'Auth\StudentLoginController@showLoginForm')->name('login.student');


Route::group(['prefix' => 'admin'], function() {
    Auth::routes();
    Route::get('logout', 'Auth\LoginController@logout_admin')->name('admin.logout');
    Route::get('/', function() {
        return redirect()->route('admin.dashboard');
    });
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    Route::get('users', 'Admin\UsersController@index')->name('admin.users');
    Route::post('users', 'Admin\UsersController@store')->name('admin.store');

});

Route::get('/home', 'HomeController@index')->name('home');
