<?php

namespace App\Http\Controllers\Teacher;

use App\Model\Project;
use App\Model\Proposal;
use App\Model\Student;
use App\Model\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Session;
use DB;
use Carbon\Carbon;

class ProposalController extends Controller
{
    public function proposalList(){


        $teacher_id = Session::get('teacher_id');

        $proposals = DB::table('proposals')

            ->join('categories','categories.id','=','proposals.category_id')
            ->where('proposals.teacher_id',$teacher_id)
            ->where('proposals.proposal_status',0)
            ->select('proposals.*','categories.category_name')
            ->get();


        return view('teacher.proposal.list',[
            'proposals' => $proposals
        ]);
    }

    public function proposalDetails($id){

        $proposals = DB::table('proposals')

            ->join('categories','categories.id','=','proposals.category_id')
            ->where('proposals.id',$id)
            ->select('proposals.*','categories.category_name')
            ->get();


        return view('teacher.proposal.project-details',[
            'details' => $proposals
        ]);
    }

    public function groupDetails($id){

        $proposals = DB::table('proposals')

            ->join('groups','groups.group_id','=','proposals.group_id')
            ->join('students','groups.student_id','=','students.student_id')
            ->where('proposals.id',$id)
            ->select('proposals.*','students.student_name','students.student_id','students.batch','students.student_email','students.student_contact_number')
            ->get();


        return view('teacher.proposal.group-details',[
            'details' => $proposals
        ]);
    }

    public function reportDownload($id){

        $report = Proposal::find($id);
        $file= public_path(). "/reports/".$report->report;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file);
    }

    public function acceptProposal(Request $request){
        $proposal = Proposal::find($request->id);
        $proposal->proposal_status =1;
        $proposal->save();

        $student = Student::where('group_id',$proposal->group_id)->first();


        $current = Carbon::now();

// add 30 days to the current time
        $trialExpires = $current->addDays(30);

        $project = new Project();
        $project->group_id = $student->group_id;
        $project->teacher_id = $proposal->teacher_id;
        $project->category_id = $proposal->category_id;
        $project->project_name = $proposal->project_name;
        $project->short_description = $proposal->short_description;
        $project->project_status = 0;
        $project->deadline = $current->addDays(180);


        $project->save();


        $teacher = Teacher::find($project->teacher_id);
        $teacher->increment("slots");

        if ($teacher->slots==5){
            $teacher->availability=0;
        }

        $teacher->save();



        return redirect('/teacher/proposals/')->with('message','Proposal accepted successfully!!');
    }


    public function cancelProposal(Request $request){
        $proposal = Proposal::find($request->id);
        $proposal->proposal_status = 2;
        $proposal->reason = $request->reason;
        $proposal->save();



        return redirect('/teacher/proposals/')->with('message','Proposal cancelled successfully!!');
    }
}
