<?php

namespace App\Http\Controllers\Teacher;

use App\Model\Project;
use App\Model\Proposal;
use App\Model\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class ProposalController extends Controller
{
    public function proposalList(){


        $teacher_id = Session::get('teacher_id');

        $proposals = DB::table('proposals')

            ->join('students','students.id','=','proposals.student_id')
            ->join('categories','categories.id','=','proposals.category_id')
            ->where('proposals.teacher_id',$teacher_id)
            ->where('proposals.proposal_status',0)
            ->select('proposals.*','students.student_name','students.student_id','categories.category_name')
            ->get();


        return view('teacher.proposal.list',[
            'proposals' => $proposals
        ]);
    }

    public function proposalDetails($id){

        $proposals = DB::table('proposals')

            ->join('students','students.id','=','proposals.student_id')
            ->join('categories','categories.id','=','proposals.category_id')
            ->where('proposals.id',$id)
            ->select('proposals.*','students.student_name','categories.category_name')
            ->get();


        return view('teacher.proposal.project-details',[
            'details' => $proposals
        ]);
    }

    public function acceptProposal(Request $request){
        $proposal = Proposal::find($request->id);
        $proposal->proposal_status =1;
        $proposal->save();

        $project = new Project();
        $project->student_id = $proposal->student_id;
        $project->teacher_id = $proposal->teacher_id;
        $project->category_id = $proposal->category_id;
        $project->project_name = $proposal->project_name;
        $project->short_description = $proposal->short_description;
        $project->project_status = 0;

        $project->save();


        $teacher = Teacher::find($project->teacher_id);
        $teacher->increment("slots");
        $teacher->save();


        return redirect('/teacher/proposals/')->with('message','Proposal accepted successfully!!');
    }


    public function cancelProposal(Request $request){
        $proposal = Proposal::find($request->id);
        $proposal->proposal_status = 2;
        $proposal->save();



        return redirect('/teacher/proposals/')->with('message','Proposal cancelled successfully!!');
    }
}
