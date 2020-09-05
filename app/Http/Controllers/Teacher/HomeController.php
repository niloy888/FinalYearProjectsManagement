<?php

namespace App\Http\Controllers\Teacher;

use App\CategoryWiseTeacher;
use App\Model\Category;
use App\Model\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class HomeController extends Controller
{
    public function index(){
        return view('teacher.home.home');
    }

    public function manageCategory(){
        return view('teacher.category.manage-category',[
            'categories' => Category::all(),
            'selectedCategories' => CategoryWiseTeacher::where('teacher_id',Session::get('teacher_id'))->get(),
        ]);
    }

    public function newCategory(Request $request){
        //return $request->all();
        $totalCategories = count($request->category_id);

        for ($i=0;$i<$totalCategories;$i++){
            $category = new CategoryWiseTeacher();
            $category->teacher_id    = $request->teacher_id;
            $category->category_id  = $request->category_id[$i];
            $category->save();
        }



        return redirect('/teacher/dashboard')->with('message','Category saved successfully!!');
    }

    public function teachersList(){


        /*$teachers = DB::table('teachers')

            ->join('category_wise_teachers','category_wise_teachers.teacher_id','=','teachers.id')
            ->select('teachers.*')
            ->get();*/

        return view('teacher.teachers.teacher-list',[
            'teachers' => Teacher::all()
        ]);
    }

    public function teacherCategoryDetails($id){

        $teacher = Teacher::find($id);

        $categoryList = DB::table('category_wise_teachers')

            ->join('teachers','category_wise_teachers.teacher_id','=','teachers.id')
            ->join('categories','category_wise_teachers.category_id','=','categories.id')
            ->where('category_wise_teachers.teacher_id',$id)
            ->select('teachers.*','categories.category_name')
            ->get();

        //return $categoryList;

        return view('teacher.teachers.category-list',[
            'categoryList' => $categoryList,
            'teacher' => $teacher
        ]);
    }
}
