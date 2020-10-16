<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function insert(Request $request)
    {
        $contact_id=$request->input('contact_id');
        $category_name=$request->input('category_name');
        $ldate = date('Y-m-d H:i:s');
        $data=array(
            'category_name'=>$category_name,"contact_id"=>$contact_id,"created_at"=>$ldate);
        $insert=DB::table('category_company')->insert($data);

        return response()->json('inserted');
    }
    public function fetchCategory()
    {
        $cat=DB::select('SELECT * FROM `category_tbl`');
        return response()->json($cat);
    }
    public function fetchCategoryList($contact_id)
    {
        $cat=DB::select('SELECT * FROM `category_company` WHERE  `contact_id`=?',[$contact_id]);
        return response()->json($cat);
    }
    public function fetchCategories()
    {
        $cat=DB::select('SELECT * FROM `category_company` ');
        return response()->json($cat);
    }
}
