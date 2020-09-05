<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function addCategory(){
        return view('admin.category.add-category');
    }

    public function newCategory(Request $request){

        $category = new Category();
        $category->category_name    = $request->category_name;
        $category->category_status  = $request->category_status;
        $category->save();

        return redirect('/category/manage')->with('message','Category created successfully!!');
    }

    public function manageCategory(){

        return view('admin.category.manage-category',[
            'categories' => Category::all()
        ]);

    }

    public function editCategory($id){

        return view('admin.category.edit-category',[
            'category' => Category::find($id)
        ]);
    }

    public function updateCategory(Request $request){

        $category = Category::find($request->id);
        $category->category_name    = $request->category_name;
        $category->category_status  = $request->category_status;
        $category->save();

        return redirect('/category/manage')->with('message','Category updated successfully!!');

    }

    public function deleteCategory(Request $request)
    {

        $category = Category::find($request->id);
        $category->delete();
        return redirect('/category/manage')->with('message', 'Category deleted successfully!!');

    }

}
