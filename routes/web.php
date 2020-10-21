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

//Student-------------------------------------------------------------------------------------------------------------
Route::get('/student/login', 'Student\AuthController@login')->name('student-login');
Route::post('/student-login-process', 'Student\AuthController@loginProcess')->name('student-login-process');
Route::get('/student/register', 'Student\AuthController@register')->name('student-register');
Route::post('/student-registration-process', 'Student\AuthController@registerProcess')->name('student-register-process');
Route::post('/student/logout', 'Student\AuthController@logout')->name('student-logout');

Route::get('/student/dashboard', 'Student\HomeController@index')->name('student-dashboard');

//Sending proposal
Route::get('/category/selection', 'Student\ProposalController@categorySelection')->name('category-selection');
Route::get('/teacher/selection/{id}', 'Student\ProposalController@teacherSelection')->name('teacher-selection');
Route::get('/proposal/fill-up/{id}', 'Student\ProposalController@proposalFillUp')->name('fill-up-proposal');
Route::post('/submit-proposal', 'Student\ProposalController@submitProposal')->name('submit-proposal');
Route::get('/proposal/status', 'Student\ProposalController@proposalStatus')->name('proposal-status');


//Project
Route::get('/project/status', 'Student\ProjectController@projectStatus')->name('project-status');


//All Projects Search
Route::get('/projects/all', 'Student\ProjectController@allProjects')->name('student-all-projects');

Route::post('/autocomplete/project','AutoCompleteController@projectName')->name('autocomplete.project');

Route::post('/final-project','Student\ProjectController@searchedProject')->name('final-project');


//Teacher-------------------------------------------------------------------------------------------------------
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


//Proposals
Route::get('/teacher/proposals/','Teacher\ProposalController@proposalList')->name('teacher-proposal-list');
Route::get('/teacher/proposal/{id}','Teacher\ProposalController@proposalDetails')->name('teacher-proposal-details');
Route::post('/accept/proposal/','Teacher\ProposalController@acceptProposal')->name('accept-proposal');
Route::post('/cancel/proposal/','Teacher\ProposalController@cancelProposal')->name('cancel-proposal');


//Projects
Route::get('/teacher/projects/ongoing','Teacher\ProjectController@ongoingProjects')->name('teacher-ongoing-projects');
Route::post('/teacher/project/completed','Teacher\ProjectController@projectCompleted')->name('project-completed');
Route::post('/teacher/project/drop','Teacher\ProjectController@projectDrop')->name('cancel-project');
Route::get('/teacher/projects/completed','Teacher\ProjectController@completedProjects')->name('teacher-completed-projects');
Route::get('/teacher/projects/dropped','Teacher\ProjectController@droppedProjects')->name('teacher-dropped-projects');
Route::get('/teacher/projects/history','Teacher\ProjectController@supervisionHistory')->name('teacher-all-projects');
