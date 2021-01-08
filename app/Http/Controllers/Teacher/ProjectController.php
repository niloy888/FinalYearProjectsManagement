<?php

namespace App\Http\Controllers\Teacher;

use App\Model\Project;
use App\Model\ProjectSubmission;
use App\Model\Proposal;
use App\Model\Student;
use App\Model\Task;
use App\Model\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Response;
use Session;

class ProjectController extends Controller
{




    public function ongoingProjects(){



        $teacher_id = Session::get('teacher_id');

        $projects = DB::table('projects')

            ->join('categories','categories.id','=','projects.category_id')
            ->where('projects.teacher_id',$teacher_id)
            ->where('projects.project_status',0)
            ->select('projects.*','categories.category_name')
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

        if ($teacher->slots<5){
            $teacher->availability=1;
        }

        $teacher->save();

        return redirect()->back()->with('message','Project Completed Successfully!!');

    }

    public function projectDrop(Request $request){

        $project = Project::find($request->id);
        $project->marks = 0;
        $project->project_status = 2;
        $project->deadline= Carbon::now();

        $students = Student::where('group_id',$project->group_id)->get();

        foreach ($students as $student){
            $student->group_id = null;
            $student->save();
        }



        $project->save();





        $teacher = Teacher::find($project->teacher_id);
        $teacher->decrement("slots");

        if ($teacher->slots<5){
            $teacher->availability=1;
        }

        $teacher->save();

        return redirect('teacher/projects/dropped')->with('message','Project Dropped Successfully!!');

    }

    public function completedProjects(){

        $teacher_id = Session::get('teacher_id');

        $projects = DB::table('projects')

            ->join('categories','categories.id','=','projects.category_id')
            ->where('projects.teacher_id',$teacher_id)
            ->where('projects.project_status',1)
            ->select('projects.*','categories.category_name')
            ->get();


        return view('teacher.projects.completed-list',[
            'projects' => $projects
        ]);
    }


    public function droppedProjects(){

        $teacher_id = Session::get('teacher_id');

        $projects = DB::table('projects')

            ->join('categories','categories.id','=','projects.category_id')
            ->where('projects.teacher_id',$teacher_id)
            ->where('projects.project_status',2)
            ->select('projects.*','categories.category_name')
            ->get();


        return view('teacher.projects.dropped-list',[
            'projects' => $projects
        ]);
    }

    public function supervisionHistory(){

        $teacher_id = Session::get('teacher_id');

        $projects = DB::table('projects')

            ->join('categories','categories.id','=','projects.category_id')
            ->where('projects.teacher_id',$teacher_id)
            ->select('projects.*','categories.category_name')
            ->orderBy('id','desc')
            ->get();


        return view('teacher.projects.supervision-history',[
            'projects' => $projects
        ]);
    }

    public function finalSubmission($id){

        $submission = ProjectSubmission::where('group_id',$id)->where('status',0)->first();
        //return $submission;
        return view('teacher.projects.review-submission',compact('submission'));
    }

    public function finalReportDownload($id){
        $report = ProjectSubmission::find($id);
        $file= public_path(). "/final-reports/".$report->final_report;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file);
    }

    public function projectFolderDownload($id){
        $report = ProjectSubmission::find($id);
        $file= public_path(). "/project-folder/".$report->project_folder;

        $headers = array(
            'Content-Type: application/zip',
        );

        return Response::download($file);
    }

    public function finalReportMark(Request $request){
        $report = ProjectSubmission::find($request->id);
        $report->report_marks = $request->report_marks;
        $report->status = 1;
        $report->save();
        $sum = 0;

        $marks = Task::where('group_id',$report->group_id)->get();
        $total = count($marks);
        $t = $total+1;

        $project = Project::where('group_id',$report->group_id)->first();
        $project->project_status=1;
        $project->deadline= Carbon::now();

        foreach ($marks as $mark){
            $sum = $sum+$mark->task_mark;
            //$total_mark = ($sum+$report->report_marks)/$t;
            $total_mark = $sum+$report->report_marks;

            $project->marks=$total_mark;
        }

        $project->save();

        return redirect('/teacher/projects/completed')->with('message','Marks Given Successfully');
    }

    public function reportRepeat(Request $request){

        $report = ProjectSubmission::find($request->id);
        $report->repeat_reason = $request->repeat_reason;
        $report->status = 2;
        $report->save();


        $report2 = Project::where('group_id',$report->group_id)->first();
        $report2->project_submission = 0;
        $report2->save();


        return redirect('/teacher/projects/ongoing')->with('message','Submission Repeated Successfully');
    }

    public function allProjects()
    {
        $projects = DB::table('projects')
            ->join('categories', 'categories.id', '=', 'projects.category_id')
            ->join('teachers', 'teachers.id', '=', 'projects.teacher_id')
            ->where('projects.project_status', 1)
            ->select('projects.*',  'categories.category_name', 'teachers.teacher_name')
            ->get();


        return view('teacher.projects.all-projects', [
            'projects' => $projects
        ]);
    }

    public function searchedProject(Request $request)
    {
        $projects = DB::table('projects')
            ->join('categories', 'categories.id', '=', 'projects.category_id')
            ->join('teachers', 'teachers.id', '=', 'projects.teacher_id')
            ->where('projects.project_name','=' ,$request->project_name)
            ->select('projects.*',  'categories.category_name', 'teachers.teacher_name')
            ->get();


        return view('teacher.projects.searched-project', [
            'projects' => $projects
        ]);
    }
}
