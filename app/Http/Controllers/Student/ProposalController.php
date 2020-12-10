<?php

namespace App\Http\Controllers\Student;

use App\Model\Category;
use App\Model\Group;
use App\Model\Proposal;
use App\Model\Student;
use App\Model\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class ProposalController extends Controller
{

    public function categorySelection(){

        $categories = Category::where('category_status',1)->get();
        return view('student.proposal.category-selection',[
            'categories' => $categories
        ]);
    }


    public function teacherSelection($id){

        Session::put('category_id', $id);

        $teachers = DB::table('teachers')

            ->join('category_wise_teachers','teachers.id','=','category_wise_teachers.teacher_id')
            ->where('category_wise_teachers.category_id',$id)
//            ->where('teachers.slots','<',5)
            ->where('teachers.availability',1)
            ->select('teachers.*')
            ->orderBy('teachers.teacher_position','asc')
            ->get();

        return view('student.proposal.teacher-selection',[
            'teachers' => $teachers
        ]);
    }

    public function proposalFillUp($id){
        Session::put('selected_teacher_id', $id);
        return view('student.proposal.fill-up-proposal');
    }

    public function submitProposal(Request $request){

        $request->validate([
            'report' => 'required|mimes:pdf,xlx,csv',
        ]);

        $fileName = time().'.'.$request->report->extension();
        $request->report->move(public_path('reports'), $fileName);


        $student = Student::where('id',$request->student_id)->first();


        $proposal = new Proposal();
        $proposal->group_id          = $student->group_id;
        $proposal->category_id       = $request->category_id;
        $proposal->teacher_id        = $request->teacher_id;
        $proposal->project_name      = $request->project_name;
        $proposal->short_description = $request->short_description;
        $proposal->proposal_status   = 0;
        $proposal->message           = $request->message;
        $proposal->report            = $fileName;

        $proposal->save();

        //$proposal = Proposal::orderBy('id','desc')->first();


        return back()->with('message','Project proposal sent successfully!!');

    }

    public function proposalStatus(){
        $student_id = Session::get('student_id');

        $student = Student::where('id',$student_id)->first();
        $group_id = $student->group_id;

        $proposals = DB::table('proposals')

            ->join('categories','categories.id','=','proposals.category_id')
            ->join('teachers','teachers.id','=','proposals.teacher_id')
            ->where('proposals.group_id',$group_id)
            ->select('proposals.*','categories.category_name','teachers.teacher_name')
            ->get();


        return view('student.proposal.proposal-status',[
            'proposals' => $proposals
        ]);
    }
}
