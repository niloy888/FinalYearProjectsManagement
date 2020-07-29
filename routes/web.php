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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');


//Student
Route::get('/student/login', 'Student\AuthController@login')->name('student-login');
Route::post('/student-login-process', 'Student\AuthController@loginProcess')->name('student-login-process');
Route::get('/student/register', 'Student\AuthController@register')->name('student-register');
Route::post('/student-registration-process', 'Student\AuthController@registerProcess')->name('student-register-process');
Route::post('/student/logout', 'Student\AuthController@logout')->name('student-logout');

Route::get('/student/dashboard', 'Student\HomeController@index')->name('student-dashboard');


//Teacher
Route::get('/teacher/login', 'Teacher\AuthController@login')->name('teacher-login');
Route::post('/teacher-login-process', 'Teacher\AuthController@loginProcess')->name('teacher-login-process');
Route::get('/teacher/register', 'Teacher\AuthController@register')->name('teacher-register');
Route::post('/teacher-registration-process', 'Teacher\AuthController@registerProcess')->name('teacher-register-process');
Route::post('/teacher/logout', 'Teacher\AuthController@logout')->name('teacher-logout');

Route::get('/teacher/dashboard', 'Teacher\HomeController@index')->name('teacher-dashboard');
