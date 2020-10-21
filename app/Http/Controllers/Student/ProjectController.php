<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class ProjectController extends Controller
{
    public function projectStatus()
    {
        $student_id = Session::get('student_id');

        $projects = DB::table('projects')
            ->join('students', 'students.id', '=', 'projects.student_id')
            ->join('categories', 'categories.id', '=', 'projects.category_id')
            ->join('teachers', 'teachers.id', '=', 'projects.teacher_id')
            ->where('projects.student_id', $student_id)
            ->select('projects.*', 'categories.category_name', 'teachers.teacher_name')
            ->get();


        return view('student.project.project-status', [
            'projects' => $projects
        ]);
    }

    public function allProjects()
    {
        $projects = DB::table('projects')
            ->join('students', 'students.id', '=', 'projects.student_id')
            ->join('categories', 'categories.id', '=', 'projects.category_id')
            ->join('teachers', 'teachers.id', '=', 'projects.teacher_id')
            ->where('projects.project_status', 1)
            ->select('projects.*', 'students.student_name', 'students.student_id', 'categories.category_name', 'teachers.teacher_name')
            ->get();


        return view('student.project.all-projects', [
            'projects' => $projects
        ]);
    }

    public function searchedProject(Request $request)
    {
        $projects = DB::table('projects')
            ->join('students', 'students.id', '=', 'projects.student_id')
            ->join('categories', 'categories.id', '=', 'projects.category_id')
            ->join('teachers', 'teachers.id', '=', 'projects.teacher_id')
            ->where('projects.project_name','=' ,$request->project_name)
            ->select('projects.*', 'students.student_name', 'students.student_id', 'categories.category_name', 'teachers.teacher_name')
            ->get();


        return view('student.project.searched-project', [
            'projects' => $projects
        ]);
    }
}
