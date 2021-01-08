<?php

namespace App\Http\Controllers\Student;

use App\Model\Group;
use App\Model\Project;
use App\Model\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class GroupController extends Controller
{
    public function createGroup()
    {
        return view('student.group.create-group');
    }

    public function submitGroup(Request $request)
    {

        $group = new Group();

        if ($request->student_id_2 == null && $request->student_id_3 == null) {
            $id1   = substr($request->student_id_1, -3);
            $batch = $request->batch;



            $student1 = Student::where('student_id', $request->student_id_1)->first();

            if ($student1){

                if ($student1->group_id == null){
                    $student1->group_id = $batch . "_" . $id1;

                    $student1->save();

                    $group->group_id   = $batch . "_" . $id1;
                    $group->group_name = $request->group_name;
                    $group->student_id = $request->student_id_1;
                    $group->batch      = $request->batch;
                    $group->save();
                }

                else{
                    return redirect()->back()->with('message', 'Student is already in a group');
                }



            }

            else{
                return redirect()->back()->with('message', 'Student not found');
            }



        } elseif ($request->student_id_3 == null) {
            $id1   = substr($request->student_id_1, -3);
            $id2   = substr($request->student_id_2, -3);
            $batch = $request->batch;


            $student1 = Student::where('student_id', $request->student_id_1)->first();
            $student2 = Student::where('student_id', $request->student_id_2)->first();

            if ($student1 && $student2) {

                if ($student1->group_id == null && $student2->group_id == null) {
                    $student1->group_id = $batch . "_" . $id1 . "_" . $id2;
                    $student2->group_id = $batch . "_" . $id1 . "_" . $id2;

                    $student1->save();
                    $student2->save();


                    $group->group_id   = $batch . "_" . $id1 . "_" . $id2;
                    $group->group_name = $request->group_name;
                    $group->student_id = $request->student_id_1;
                    $group->batch      = $request->batch;
                    $group->save();

                    $group             = new Group();
                    $group->group_id   = $batch . "_" . $id1 . "_" . $id2;
                    $group->group_name = $request->group_name;
                    $group->student_id = $request->student_id_2;
                    $group->batch      = $request->batch;
                    $group->save();
                } else {
                    return redirect()->back()->with('message', 'Student is already in a group');

                }

            } else {
                return redirect()->back()->with('message', 'Student not found');
            }


        } else {
            $id1   = substr($request->student_id_1, -3);
            $id2   = substr($request->student_id_2, -3);
            $id3   = substr($request->student_id_3, -3);
            $batch = $request->batch;

            $student1 = Student::where('student_id', $request->student_id_1)->first();
            $student2 = Student::where('student_id', $request->student_id_2)->first();
            $student3 = Student::where('student_id', $request->student_id_3)->first();


            if ($student1 && $student2 && $student3) {



                if ($student1->group_id == null && $student2->group_id == null && $student3->group_id == null) {


                    $student1->group_id = $batch . "_" . $id1 . "_" . $id2 . "_" . $id3;
                    $student2->group_id = $batch . "_" . $id1 . "_" . $id2 . "_" . $id3;
                    $student3->group_id = $batch . "_" . $id1 . "_" . $id2 . "_" . $id3;


                    $student1->save();
                    $student2->save();
                    $student3->save();

                    $group->group_id   = $batch . "_" . $id1 . "_" . $id2 . "_" . $id3;
                    $group->group_name = $request->group_name;
                    $group->student_id = $request->student_id_1;
                    $group->batch      = $request->batch;
                    $group->save();


                    $group             = new Group();
                    $group->group_id   = $batch . "_" . $id1 . "_" . $id2 . "_" . $id3;
                    $group->group_name = $request->group_name;
                    $group->student_id = $request->student_id_2;
                    $group->batch      = $request->batch;
                    $group->save();

                    $group             = new Group();
                    $group->group_id   = $batch . "_" . $id1 . "_" . $id2 . "_" . $id3;
                    $group->group_name = $request->group_name;
                    $group->student_id = $request->student_id_3;
                    $group->batch      = $request->batch;
                    $group->save();

                }

                else {
                    return redirect()->back()->with('message', 'Student is already in a group');

                }

            }


            else {


                return redirect()->back()->with('message', 'Student not found');
            }


        }

        return back()->with('message', 'Group created successfully!!');


    }

    public function groupInfo()
    {
        $student = Student::find(Session::get('student_id'));

        $students = Student::where('group_id', $student->group_id)->get();

        $number = count($students);

        return view('student.group.group-info')->with(['students' => $students, 'total' => $number]);


    }

    public function groupChange()
    {
        $student = Student::find(Session::get('student_id'));
        $project = Project::where('group_id', $student->group_id)->first();


        $project->group_change = 1;
        $project->save();


        session()->flash('message', 'Group changing request sent successfully');
        return redirect(route('group-info'));
    }
}
