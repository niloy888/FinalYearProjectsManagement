<?php

namespace App\Http\Controllers\Student;

use App\Model\Group;
use App\Model\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GroupController extends Controller
{
    public function createGroup(){
        return view('student.group.create-group');
    }

    public function submitGroup(Request $request){

        $group = new Group();

        if ($request->student_id_2==null && $request->student_id_3==null){
            $id1 = substr($request->student_id_1,-3);
            $batch = $request->batch;

            $group->group_id = $batch."_".$id1;
            $group->group_name = $request->group_name;
            $group->student_id = $request->student_id_1;
            $group->batch = $request->batch;
            $group->save();

            $student1 = Student::where('student_id',$request->student_id_1)->first();

            $student1->group_id = $batch."_".$id1;

            $student1->save();
        }
        elseif ($request->student_id_3==null){
            $id1 = substr($request->student_id_1,-3);
            $id2 = substr($request->student_id_2,-3);
            $batch = $request->batch;

            $group->group_id = $batch."_".$id1."_".$id2;
            $group->group_name = $request->group_name;
            $group->student_id = $request->student_id_1;
            $group->batch = $request->batch;
            $group->save();

            $group = new Group();
            $group->group_id = $batch."_".$id1."_".$id2;
            $group->group_name = $request->group_name;
            $group->student_id = $request->student_id_2;
            $group->batch = $request->batch;
            $group->save();

            $student1 = Student::where('student_id',$request->student_id_1)->first();
            $student2 = Student::where('student_id',$request->student_id_2)->first();

            $student1->group_id = $batch."_".$id1."_".$id2;
            $student2->group_id = $batch."_".$id1."_".$id2;

            $student1->save();
            $student2->save();
        }
        else{
            $id1 = substr($request->student_id_1,-3);
            $id2 = substr($request->student_id_2,-3);
            $id3 = substr($request->student_id_3,-3);
            $batch = $request->batch;

            $group->group_id = $batch."_".$id1."_".$id2."_".$id3;
            $group->group_name = $request->group_name;
            $group->student_id = $request->student_id_1;
            $group->batch = $request->batch;
            $group->save();


            $group = new Group();
            $group->group_id = $batch."_".$id1."_".$id2."_".$id3;
            $group->group_name = $request->group_name;
            $group->student_id = $request->student_id_2;
            $group->batch = $request->batch;
            $group->save();

            $group = new Group();
            $group->group_id = $batch."_".$id1."_".$id2."_".$id3;
            $group->group_name = $request->group_name;
            $group->student_id = $request->student_id_3;
            $group->batch = $request->batch;
            $group->save();

            $student1 = Student::where('student_id',$request->student_id_1)->get();
            $student2 = Student::where('student_id',$request->student_id_2)->get();
            $student3 = Student::where('student_id',$request->student_id_3)->get();

            $student1->group_id = $batch."_".$id1."_".$id2."_".$id3;
            $student2->group_id = $batch."_".$id1."_".$id2."_".$id3;
            $student3->group_id = $batch."_".$id1."_".$id2."_".$id3;


            $student1->save();
            $student2->save();
            $student3->save();
        }

        return back()->with('message','Group created successfully!!');


    }
}
