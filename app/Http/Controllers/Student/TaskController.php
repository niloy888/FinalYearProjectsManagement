<?php

namespace App\Http\Controllers\Student;

use App\Model\Project;
use App\Model\ProjectSubmission;
use App\Model\Student;
use App\Model\Task;
use App\Model\TaskImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Session;


class TaskController extends Controller
{
    public function addTask(){
        return view('student.task.add-task');
    }

    public function submitTask(Request $request){

        $request->validate([
            'task_pdf' => 'mimes:pdf,xlx,csv',
        ]);

        if ($request->task_pdf){
            $fileName = time().'.'.$request->task_pdf->extension();
            $request->task_pdf->move(public_path('task-pdf'), $fileName);

            $student = Student::find($request->student_id);
            $task = new Task();
            $task->group_id = $student->group_id;
            $task->task_description = $request->task_description;
            $task->github_link = $request->github_link;
            $task->task_pdf = $fileName;
            $task->save();
        }

        else{
            $student = Student::find($request->student_id);
            $task = new Task();
            $task->group_id = $student->group_id;
            $task->task_description = $request->task_description;
            $task->github_link = $request->github_link;
            $task->save();
        }




        $taskImage = $request->file('task_images');


        //return $taskImage;

        if ($taskImage){

            foreach ($taskImage as $t){
                $imageName    = $t->getClientOriginalName();
                $directory    = 'task-images/';
                //$productImage->move($directory,$imageName);
                $imageUrl = $directory.$imageName;
                Image::make($t)->resize(200,200)->save($imageUrl);

                $task = Task::orderBy('id','desc')->first();

                $task_images = new TaskImage();
                $task_images->task_id = $task->id;
                $task_images->task_image = $imageUrl;
                $task_images->group_id = $student->group_id;
                $task_images->save();
            }
        }


        return redirect()->back()->with('message','Task Submitted Successfully');

    }



    public function taskList(){
        $student = Student::find(Session::get('student_id'));
        $tasks = Task::where('group_id',$student->group_id)->orderBy('id','desc')->get();
        return view('student.task.task-list',compact('tasks'));
    }

    public function projectSubmission(){
        return view('student.task.submit-project');
    }

    public function submitProject(Request $request){

        /*$request->validate([
            'report' => 'required|mimes:zip,rar',
        ]);*/

        if ($request->project_folder && $request->final_report){

            $fileName = time().'.'.$request->project_folder->extension();
            $request->project_folder->move(public_path('project-folder'), $fileName);

            /*$request->validate([
                'report' => 'required|mimes:pdf,xlx,csv',
            ]);*/

            $fileName2 = time().'.'.$request->final_report->extension();
            $request->final_report->move(public_path('final-reports'), $fileName2);

            $student = Student::find(Session::get('student_id'));

            $submission = new ProjectSubmission();
            $submission->group_id = $student->group_id;
            $submission->project_folder = $fileName;
            $submission->github_link = $request->github_link;
            $submission->final_report = $fileName2;
            $submission->status = 0;
            $submission->save();

            $project = Project::where('group_id',$student->group_id)->first();
            $project->project_submission = 1;
            $project->save();
        }

        elseif ($request->project_folder){
            $fileName = time().'.'.$request->project_folder->extension();
            $request->project_folder->move(public_path('project-folder'), $fileName);

            /*$request->validate([
                'report' => 'required|mimes:pdf,xlx,csv',
            ]);*/


            $student = Student::find(Session::get('student_id'));

            $submission = new ProjectSubmission();
            $submission->group_id = $student->group_id;
            $submission->project_folder = $fileName;
            $submission->github_link = $request->github_link;
            $submission->status = 0;
            $submission->save();

            $project = Project::where('group_id',$student->group_id)->first();
            $project->project_submission = 1;
            $project->save();
        }

        elseif ($request->final_report){


            /*$request->validate([
                'report' => 'required|mimes:pdf,xlx,csv',
            ]);*/

            $fileName2 = time().'.'.$request->final_report->extension();
            $request->final_report->move(public_path('final-reports'), $fileName2);

            $student = Student::find(Session::get('student_id'));

            $submission = new ProjectSubmission();
            $submission->group_id = $student->group_id;
            $submission->github_link = $request->github_link;
            $submission->final_report = $fileName2;
            $submission->status = 0;
            $submission->save();

            $project = Project::where('group_id',$student->group_id)->first();
            $project->project_submission = 1;
            $project->save();
        }


        return redirect('/submission/status')->with('message','Project Submitted Successfully');
    }

    public function submissionStatus(){
        $student = Student::find(Session::get('student_id'));
        $status = ProjectSubmission::where('group_id',$student->group_id)->orderBy('id','desc')->get();
        return view('student.task.submission-status',compact('status'));
    }

    public function repeatReason($id){
        $student = ProjectSubmission::find($id);
        return view('student.task.submission-repeat',compact('student'));
    }
}
