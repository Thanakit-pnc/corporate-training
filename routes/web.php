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
    return redirect('login');
});

Route::get('login', 'Auth\StudentLoginController@showLoginForm')->name('login.student');
Route::post('login', 'Auth\StudentLoginController@login');
Route::get('student-logout', 'Auth\StudentLoginController@studentLogout')->name('logout.student');

Route::group(['middleware' => 'auth:student'], function() {

    Route::get('exam/{number}', 'ExamController@index')->name('exam.test');
    Route::post('exam/{number}', 'ExamController@store');

    Route::get('success', function() {
        return view('success');
    });
});

Route::group(['prefix' => 'admin'], function() {
    Auth::routes();
    Route::get('logout', 'Auth\LoginController@logout_admin')->name('admin.logout');
    Route::get('/', function() {
        return redirect()->route('admin.dashboard');
    });
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    Route::get('users', 'Admin\UsersController@index')->name('users.index');
    Route::post('users', 'Admin\UsersController@store')->name('users.store');
    Route::get('users/{id}/edit', 'Admin\UsersController@edit')->name('users.edit');
    Route::post('users/{id}/update', 'Admin\UsersController@update')->name('users.update');
    Route::post('users/{id}/update_password', 'Admin\UsersController@update_password')->name('users.update_password');
    Route::get('delete_user/{id}', 'Admin\UsersController@delete_user')->name('users.delete');

    Route::post('create-group', 'Admin\DashboardController@create_group')->name('create-group');

    Route::get('group/{id}', 'Admin\GroupController@index')->name('group.index');
    Route::post('group/{id}', 'Admin\GroupController@store')->name('group.store');

    Route::get('students/{group_id}', 'Admin\GroupController@students')->name('students.all');    
    Route::post('check-to-add/{id}', 'Admin\GroupController@checkToAdd')->name('check-to-add');

    Route::post('update-student', 'Admin\StudentController@update')->name('student.update');

    Route::get('group/{group}/view/{student_id}', 'Admin\ViewStudentController@index')->name('view.index');
    Route::post('view/update', 'Admin\ViewStudentController@update')->name('view.update');
});

Route::get('/home', 'HomeController@index')->name('home');
