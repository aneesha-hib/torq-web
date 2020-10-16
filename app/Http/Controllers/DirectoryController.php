<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectoryController extends Controller
{
    public function insert(Request $request)
    {
        $contact_id = $request->input('contact_id');
        $company_description = $request->input('company_description');
        $image1 = $request->input('image1');
        $image2 = $request->input('image2');
        $image3 = $request->input('image3');
        $ldate = date('Y-m-d H:i:s');
        $directory_type = $request->input('directory_type');
        $user_id=$request->input('user_id');
        $status = '0';
        $data=array(
            'contact_id'=>$contact_id,"company_description"=>$company_description,"image1"=>$image1,"image2"=>$image2,"image3"=>$image3,"status"=>$status,
            "created_at"=>$ldate,"directory_type"=>$directory_type,"user_id"=>$user_id);
        $insert=DB::table('directorypost')->insert($data);
        return response()->json("Successfully Registered",200);
    }
    public function fetchDetails($directory_type)
    {
        $result = DB::select('select * from `company` INNER join `directorypost` where company.contact_id = directorypost.contact_id AND directorypost.directory_type=?', [$directory_type]);
        return response()->json($result);
    }
    public function fetchBranchDetails($contact_id)
    {
        $result = DB::select('select * from `company` INNER join `directorypost` where company.contact_id = directorypost.contact_id AND directorypost.contact_id=?', [$contact_id]);
        return response()->json($result);
    }
}
