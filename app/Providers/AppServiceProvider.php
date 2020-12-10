<?php

namespace App\Providers;

use App\Model\Project;
use App\Model\Student;
use Illuminate\Support\ServiceProvider;
use Session;
use View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('student.master', function ($view){
            $student_id = Session::get('student_id');

            $student = Student::find($student_id);
            $view->with('project_id', Project::where('group_id',$student->group_id)->orderBy('id','desc')->first());
            $view->with('group_id', Student::find($student_id));
        });
    }
}
