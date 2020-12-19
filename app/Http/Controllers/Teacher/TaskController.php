<?php

namespace App\Http\Controllers\Teacher;

use App\Model\Task;
use App\Model\TaskImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;


class TaskController extends Controller
{
    public function projectTask($id){
        $tasks = Task::where('group_id',$id)->orderBy('id','desc')->get();



        return view('teacher.projects.task-list',compact('tasks'));
    }

    public function reportDownload($id){

        $report = Task::find($id);
        $file= public_path(). "/task-pdf/".$report->task_pdf;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file);
    }

    public function taskImages($id){
        $taskImages = TaskImage::where('task_id',$id)->get();
        return view('teacher.projects.task-images',compact('taskImages'));
    }

    public function taskMark(Request $request){
        $task = Task::find($request->id);
        $task->task_mark = $request->task_mark;
        $task->save();
        return redirect()->back()->with('message','Marks Given Successfully');
    }
}
