<?php

namespace App\Http\Controllers\Teacher;

use App\Model\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('teacher.auth.register');

    }


    public function registerProcess(Request $request)
    {

        $teacher = new Teacher();
        $teacher->teacher_name = $request->teacher_name;
        $teacher->teacher_code = $request->teacher_code;
        $teacher->teacher_email = $request->teacher_email;
        $teacher->password = bcrypt($request->password);
        $teacher->teacher_contact_number = $request->teacher_contact_number;
        $teacher->save();

        Session::put('teacher_id', $teacher->id);
        Session::put('teacher_name', $teacher->teacher_name);
        Session::put('teacher_code', $teacher->teacher_code);
        Session::put('teacher_email', $teacher->teacher_email);
        Session::put('teacher_contact_number', $teacher->teacher_contact_number);

        return redirect('/teacher/dashboard');
    }


    public function login()
    {
        return view('teacher.auth.login');

    }

    public function loginProcess(Request $request)
    {
        $teacher = Teacher::where('teacher_email', $request->teacher_email)->first();
        if ($teacher) {
            if (password_verify($request->password, $teacher->password)) {
                Session::put('teacher_id', $teacher->id);
                Session::put('teacher_code', $teacher->teacher_code);
                Session::put('teacher_name', $teacher->teacher_name);
                Session::put('teacher_email', $teacher->teacher_email);
                Session::put('teacher_contact_number', $teacher->teacher_contact_number);

                return redirect('/teacher/dashboard');

            } else {
                return redirect('teacher-login')->with('message', 'Wrong Password!!');
            }
        } else {
            return redirect('teacher-login')->with('message', 'Invalid email!!');
        }

    }


    public function logout(Request $request)
    {


        Session::forget($request->teacher_id);
        /* Session::forget('student_id');
         Session::forget('student_id_varsity');
         Session::forget('student_name');
         Session::forget('student_email');
         Session::forget('student_contact_number');*/

        return redirect('/teacher/login');

    }
}
