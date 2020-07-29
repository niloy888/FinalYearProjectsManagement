<?php

namespace App\Http\Controllers\Student;

use App\Model\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class AuthController extends Controller
{


    public function register()
    {
        return view('student.auth.register');

    }


    public function registerProcess(Request $request)
    {

        $student = new Student();
        $student->student_name = $request->student_name;
        $student->student_id = $request->student_id;
        $student->student_email = $request->student_email;
        $student->password = bcrypt($request->password);
        $student->student_contact_number = $request->student_contact_number;
        $student->save();

        Session::put('student_id', $student->id);
        Session::put('student_name', $student->student_name);
        Session::put('student_id_varsity', $student->student_id);
        Session::put('student_email', $student->student_email);
        Session::put('student_contact_number', $student->student_contact_number);

        return redirect('/student/dashboard');
    }


    public function login()
    {
        return view('student.auth.login');

    }

    public function loginProcess(Request $request)
    {
        $student = Student::where('student_email', $request->student_email)->first();
        if ($student) {
            if (password_verify($request->password, $student->password)) {
                Session::put('student_id', $student->id);
                Session::put('student_id_varsity', $student->student_id);
                Session::put('student_name', $student->student_name);
                Session::put('student_email', $student->student_email);
                Session::put('student_contact_number', $student->student_contact_number);

                return redirect('/student/dashboard');

            } else {
                return redirect('student-login')->with('message', 'Wrong Password!!');
            }
        } else {
            return redirect('student-login')->with('message', 'Invalid email!!');
        }

    }


    public function logout(Request $request)
    {


        Session::forget($request->student_id);
       /* Session::forget('student_id');
        Session::forget('student_id_varsity');
        Session::forget('student_name');
        Session::forget('student_email');
        Session::forget('student_contact_number');*/

        return redirect('/student/login');

    }


}
