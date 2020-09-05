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


//Admin
Route::get('/category/add', 'Admin\CategoryController@addCategory')->name('add-category');
Route::post('/category/new', 'Admin\CategoryController@newCategory')->name('new-category');
Route::get('/category/manage','Admin\CategoryController@manageCategory')->name('manage-category');
Route::get('/category/edit/{id}','Admin\CategoryController@editCategory')->name('edit-category');
Route::post('/category/update', 'Admin\CategoryController@updateCategory')->name('update-category');
Route::post('/category/delete}','Admin\CategoryController@deleteCategory')->name('delete-category');

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
Route::get('/teacher/category/','Teacher\HomeController@manageCategory')->name('teacher-category');
Route::post('/teacher/category/', 'Teacher\HomeController@newCategory')->name('teacher-category-add');

Route::get('/teacher/list/','Teacher\HomeController@teachersList')->name('teacher-list');
Route::get('/teacher/category/details/{id}','Teacher\HomeController@teacherCategoryDetails')->name('teacher-category-details');
