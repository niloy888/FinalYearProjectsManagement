<?php

namespace App\Http\Controllers\Teacher;

use App\Model\Project;
use App\Model\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class ProjectController extends Controller
{




    public function ongoingProjects(){




        $teacher_id = Session::get('teacher_id');

        $projects = DB::table('projects')

            ->join('students','students.id','=','projects.student_id')
            ->join('categories','categories.id','=','projects.category_id')
            ->where('projects.teacher_id',$teacher_id)
            ->where('projects.project_status',0)
            ->select('projects.*','students.student_name','students.student_id','categories.category_name')
            ->get();


        return view('teacher.projects.ongoing-list',[
            'projects' => $projects
        ]);
    }

    public function projectCompleted(Request $request){

        $project = Project::find($request->id);
        $project->marks = $request->marks;
        $project->project_status = 1;
        $project->save();

        $teacher = Teacher::find($project->teacher_id);
        $teacher->decrement("slots");
        $teacher->save();

        return redirect()->back()->with('message','Project Completed Successfully!!');

    }

    public function projectDrop(Request $request){

        $project = Project::find($request->id);
        $project->marks = 0;
        $project->project_status = 2;
        $project->save();

        $teacher = Teacher::find($project->teacher_id);
        $teacher->decrement("slots");
        $teacher->save();

        return redirect()->back()->with('message','Project Dropped Successfully!!');

    }

    public function completedProjects(){

        $teacher_id = Session::get('teacher_id');

        $projects = DB::table('projects')

            ->join('students','students.id','=','projects.student_id')
            ->join('categories','categories.id','=','projects.category_id')
            ->where('projects.teacher_id',$teacher_id)
            ->where('projects.project_status',1)
            ->select('projects.*','students.student_name','students.student_id','categories.category_name')
            ->get();


        return view('teacher.projects.completed-list',[
            'projects' => $projects
        ]);
    }


    public function droppedProjects(){

        $teacher_id = Session::get('teacher_id');

        $projects = DB::table('projects')

            ->join('students','students.id','=','projects.student_id')
            ->join('categories','categories.id','=','projects.category_id')
            ->where('projects.teacher_id',$teacher_id)
            ->where('projects.project_status',2)
            ->select('projects.*','students.student_name','students.student_id','categories.category_name')
            ->get();


        return view('teacher.projects.dropped-list',[
            'projects' => $projects
        ]);
    }

    public function supervisionHistory(){

        $teacher_id = Session::get('teacher_id');

        $projects = DB::table('projects')

            ->join('students','students.id','=','projects.student_id')
            ->join('categories','categories.id','=','projects.category_id')
            ->where('projects.teacher_id',$teacher_id)
            ->select('projects.*','students.student_name','students.student_id','categories.category_name')
            ->get();


        return view('teacher.projects.supervision-history',[
            'projects' => $projects
        ]);
    }
}
