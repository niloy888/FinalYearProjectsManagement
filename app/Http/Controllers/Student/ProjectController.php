<?php

namespace App\Http\Controllers\Student;

use App\Model\Project;
use App\Model\ProjectSubmission;
use App\Model\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class ProjectController extends Controller
{
    public function projectStatus()
    {
        $student_id = Session::get('student_id');

        $student = Student::find($student_id);

        $group_id = Project::where('group_id',$student->group_id)->orderBy('id','desc')->first();




        $projects = DB::table('projects')
            ->join('categories', 'categories.id', '=', 'projects.category_id')
            ->join('teachers', 'teachers.id', '=', 'projects.teacher_id')
            ->where('projects.group_id', $student->group_id)
            ->select('projects.*', 'categories.category_name', 'teachers.teacher_name')
            ->get();


        return view('student.project.project-status', [
            'projects' => $projects,
            'group_id' => $group_id,

        ]);
    }

    public function allProjects()
    {
        $projects = DB::table('projects')
            ->join('categories', 'categories.id', '=', 'projects.category_id')
            ->join('teachers', 'teachers.id', '=', 'projects.teacher_id')
            ->join('project_submissions', 'project_submissions.group_id', '=', 'projects.group_id')
            ->where('projects.project_status', 1)
            ->select('projects.*',  'categories.category_name', 'teachers.teacher_name','project_submissions.final_report')
            ->get();


        return view('student.project.all-projects', [
            'projects' => $projects
        ]);
    }

    public function searchedProject(Request $request)
    {
        $projects = DB::table('projects')
            ->join('categories', 'categories.id', '=', 'projects.category_id')
            ->join('teachers', 'teachers.id', '=', 'projects.teacher_id')
            ->join('project_submissions', 'project_submissions.group_id', '=', 'projects.group_id')
            ->where('projects.project_name','=' ,$request->project_name)
            ->select('projects.*',  'categories.category_name', 'teachers.teacher_name','project_submissions.final_report')
            ->get();


        return view('student.project.searched-project', [
            'projects' => $projects
        ]);
    }

    public function googleSearch(Request $request){
        return redirect('https://www.google.com/search?q='.$request->project_name);
    }

    public function viewReport($id){

        $report = ProjectSubmission::where('group_id',$id)->first();
        $file= public_path(). "/final-reports/".$report->final_report;
        return response()->file($file);

        //return $report;

    }
}
