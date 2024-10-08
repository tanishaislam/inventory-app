<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    function CategoryPage(){
        return View('pages.dashboard.category-page');
    }

    function CategoryList(Request $request){
        $user_id=$request->header('id');
        return Category::where('user_id',$user_id)->get();
    }

    function CategoryCreate(Request $request){
        $user_id=$request->header('id');
        return Category::create([
            'name' => $request->input('name'),
            'user_id'=> $user_id
        ]);
    }

    function CategoryById(Request $request){
        $category_id=$request->input('id');
        $user_id=$request->header('id');
        return Category::where('id', $category_id)->where('user_id',$user_id)->first();
    }

    function CategoryDelete(Request $request){
        $category_id=$request->input('id');
        $user_id=$request->header('id');
        return Category::where('id', $category_id)->where('user_id',$user_id)->delete();
    }

    function CategoryUpadate(Request $request){
        $category_id=$request->input('id');
        $user_id=$request->header('id');
        return Category::where('id', $category_id)->where('user_id',$user_id)->update([
            'name'=>$request->input('name')
        ]);
    }
}
