<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function insert(Request $request){
        $contact_id=$request->input('contact_id');
        $brand_name=$request->input('brand_name');
        $brand_image=$request->input('brand_image');
        $ldate = date('Y-m-d H:i:s');
        DB::insert('INSERT INTO `brand_company`(`contact_id`, `brand_name`, `brand_image`, `created_at`)
         VALUES (?,?,?,?)', [$contact_id,$brand_name,$brand_image,$ldate]);
         return response()->json('Brand inserted successfully');
    }
    public function fetchBrand()
    {
        $cat=DB::select('SELECT * FROM `brand_tbl`');
        return response()->json($cat);
    }
    public function fetchBrandList($contact_id)
    {
        $cat=DB::select('SELECT * FROM `brand_company` WHERE `contact_id`=?',[$contact_id]);
        return response()->json($cat);
    }
    public function fetchVehicleBrands(){
        $result=DB::select('SELECT * from brand_tbl LIMIT 3');
        return response()->json($result);

    }
    public function fetchVehicleBrands1(){
        $result=DB::select('SELECT * from brand_tbl');
        return response()->json($result);

    }
}
