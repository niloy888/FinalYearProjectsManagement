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

//Make a group
Route::get('/group/create', 'Student\GroupController@createGroup')->name('create-group');
Route::post('/group/submit', 'Student\GroupController@submitGroup')->name('submit-group');


Route::get('/group/info', 'Student\GroupController@groupInfo')->name('group-info');
Route::get('/group/change', 'Student\GroupController@groupChange')->name('group-change');


//Sending proposal
Route::get('/category/selection', 'Student\ProposalController@categorySelection')->name('category-selection');
Route::get('/teacher/selection/{id}', 'Student\ProposalController@teacherSelection')->name('teacher-selection');
Route::get('/proposal/fill-up/{id}', 'Student\ProposalController@proposalFillUp')->name('fill-up-proposal');
Route::post('/submit-proposal', 'Student\ProposalController@submitProposal')->name('submit-proposal');
Route::get('/proposal/status', 'Student\ProposalController@proposalStatus')->name('proposal-status');


//Project
Route::get('/project/status', 'Student\ProjectController@projectStatus')->name('project-status');

Route::get('/project/task/add', 'Student\TaskController@addTask')->name('student-task-add');
Route::post('/project/task/submit', 'Student\TaskController@submitTask')->name('student-task-submit');

Route::get('/project/task/list', 'Student\TaskController@taskList')->name('student-task-list');

Route::get('/project/submit', 'Student\TaskController@projectSubmission')->name('project-submission');
Route::post('/project/submit', 'Student\TaskController@submitProject')->name('submit-project');
Route::get('/submission/status', 'Student\TaskController@submissionStatus')->name('submission-status');
Route::get('/submission/repeat-reason/{id}', 'Student\TaskController@repeatReason')->name('submission-repeat-reason');


//All Projects Search
Route::get('/projects/all', 'Student\ProjectController@allProjects')->name('student-all-projects');

Route::post('/autocomplete/project','AutoCompleteController@projectName')->name('autocomplete.project');

Route::post('/final-project','Student\ProjectController@searchedProject')->name('final-project');

Route::post('/google-search','Student\ProjectController@googleSearch')->name('google-search');

Route::get('/report/view/{id}', 'Student\ProjectController@viewReport')->name('final-report-view');


//Teacher-------------------------------------------------------------------------------------------------------
Route::get('/teacher/login', 'Teacher\AuthController@login')->name('teacher-login');
Route::post('/teacher-login-process', 'Teacher\AuthController@loginProcess')->name('teacher-login-process');
Route::get('/teacher/register', 'Teacher\AuthController@register')->name('teacher-register');
Route::post('/teacher-registration-process', 'Teacher\AuthController@registerProcess')->name('teacher-register-process');
Route::post('/teacher/logout', 'Teacher\AuthController@logout')->name('teacher-logout');

Route::get('/teacher/dashboard', 'Teacher\HomeController@index')->name('teacher-dashboard');
Route::get('/teacher/profile', 'Teacher\HomeController@profile')->name('teacher-profile');
Route::post('/teacher/available', 'Teacher\HomeController@submitAvailability')->name('submit-availability');
Route::get('/teacher/category/','Teacher\HomeController@manageCategory')->name('teacher-category');
Route::post('/teacher/category/', 'Teacher\HomeController@newCategory')->name('teacher-category-add');

Route::get('/teacher/list/','Teacher\HomeController@teachersList')->name('teacher-list');
Route::get('/teacher/details/{id}','Teacher\HomeController@teacherCategoryDetails')->name('teacher-category-details');


//Proposals
Route::get('/teacher/proposals/','Teacher\ProposalController@proposalList')->name('teacher-proposal-list');
Route::get('/teacher/proposal/{id}','Teacher\ProposalController@proposalDetails')->name('teacher-proposal-details');
Route::get('/teacher/proposal/group/{id}','Teacher\ProposalController@groupDetails')->name('proposal-group-details');
Route::get('/report/download/{id}','Teacher\ProposalController@reportDownload')->name('teacher-report-download');
Route::post('/accept/proposal/','Teacher\ProposalController@acceptProposal')->name('accept-proposal');
Route::post('/cancel/proposal/','Teacher\ProposalController@cancelProposal')->name('cancel-proposal');


//Projects
Route::get('/teacher/projects/ongoing','Teacher\ProjectController@ongoingProjects')->name('teacher-ongoing-projects');
Route::get('/teacher/project/task/{id}','Teacher\TaskController@projectTask')->name('project-task');
Route::get('/teacher/task/images/{id}','Teacher\TaskController@taskImages')->name('task-images');
Route::get('/task-pdf/download/{id}','Teacher\TaskController@reportDownload')->name('task-pdf-download');

Route::get('/request/change-group/{id}','Teacher\TaskController@changeGroupRequest')->name('group-change-request');
Route::get('/remove/student/{id}','Teacher\TaskController@removeStudent')->name('remove-student');


Route::post('/teacher/task/mark/','Teacher\TaskController@taskMark')->name('task-mark');
Route::post('/teacher/project/completed','Teacher\ProjectController@projectCompleted')->name('project-completed');
Route::post('/teacher/project/drop','Teacher\ProjectController@projectDrop')->name('cancel-project');
Route::get('/teacher/projects/completed','Teacher\ProjectController@completedProjects')->name('teacher-completed-projects');
Route::get('/teacher/projects/dropped','Teacher\ProjectController@droppedProjects')->name('teacher-dropped-projects');
Route::get('/teacher/projects/history','Teacher\ProjectController@supervisionHistory')->name('teacher-all-projects');


Route::get('/teacher/final-submission/{id}','Teacher\ProjectController@finalSubmission')->name('final-submission');

Route::get('/final-report/download/{id}','Teacher\ProjectController@finalReportDownload')->name('final-report-download');
Route::get('/project-folder/download/{id}','Teacher\ProjectController@projectFolderDownload')->name('project-folder-download');
Route::post('/teacher/final-report/mark/','Teacher\ProjectController@finalReportMark')->name('final-report-mark');
Route::post('/teacher/final-report/repeat/','Teacher\ProjectController@reportRepeat')->name('final-report-repeat');



Route::get('/teacher/projects/', 'Teacher\ProjectController@allProjects')->name('university-all-projects');
Route::post('/teacher/final-project','Teacher\ProjectController@searchedProject')->name('teacher-final-project');
