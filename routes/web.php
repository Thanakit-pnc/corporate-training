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

    Route::get('exam', 'ExamController@index')->name('exam.test');
    Route::post('exam', 'ExamController@store');

    Route::get('success', function() {
        return view('success');
    });
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', function() {
        return redirect()->route('admin.dashboard');
    });
    Auth::routes();
    Route::get('logout', 'Auth\LoginController@logout_admin')->name('admin.logout');
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

    Route::get('users', 'Admin\UsersController@index')->name('users.index');
    Route::post('users', 'Admin\UsersController@store')->name('users.store');
    Route::get('users/{id}/edit', 'Admin\UsersController@edit')->name('users.edit');
    Route::post('users/{id}/update', 'Admin\UsersController@update')->name('users.update');
    Route::post('users/{id}/update_password', 'Admin\UsersController@update_password')->name('users.update_password');
    Route::get('delete_user/{id}', 'Admin\UsersController@delete_user')->name('users.delete');

    Route::post('create-group', 'Admin\DashboardController@create_group')->name('create-group');

    Route::post('company/update/{company}', 'Admin\DashboardController@update')->name('company.update');

    Route::get('company/{company}', 'Admin\CompanyController@index')->name('company.index');
    Route::post('company/{company}', 'Admin\CompanyController@store')->name('company.store');

    Route::get('ex-students/{company_id}', 'Admin\CompanyController@ex_students')->name('exstudents.all');    
    Route::post('check-to-add/{company_id}', 'Admin\CompanyController@checkToAdd')->name('check-to-add');

    Route::post('update-student', 'Admin\StudentController@update')->name('student.update');

    Route::get('group/{company_student}', 'Admin\ViewStudentController@index')->name('view.index');
    Route::post('view/update/{student_result}', 'Admin\ViewStudentController@update')->name('view.update');

    Route::get('export-pdf/{company}', 'Admin\PdfController@index')->name('pdf.index');
});

Route::get('/home', 'HomeController@index')->name('home');
