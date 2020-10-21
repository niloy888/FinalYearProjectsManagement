<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AutoCompleteController extends Controller
{

    public function projectName(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            /*$data = DB::table('bookings')
                ->join('students', 'bookings.student_id', '=', 'students.id')
                ->where('students.name','LIKE',"%{$query}%")
                ->get();*/

            $data = DB::table('projects')
                ->where('project_name', 'LIKE', "%{$query}%")
                ->where('project_status', 1)
                ->get();

            $output = '<ul class="dropdown-menu col-md-4" style="display:block;position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="ml-3 mb-1" style="font-size:20px; color: black"  id="teacher"><a href="#">' . $row->project_name . '</a></li>';
            }

            $output .= '</ul>';
            echo $output;
        }
    }

}
