<?php

namespace App\Http\Controllers\Student;

use App\Model\Group;
use App\Model\Project;
use App\Model\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class HomeController extends Controller
{
    public function index(){

        $student_id = Session::get('student_id');

        $student = Student::find($student_id);

        $group_id = Project::where('group_id',$student->group_id)->orderBy('id','desc')->first();

        //return $group_id;

        return view('student.home.home',compact('group_id'));
    }
}
