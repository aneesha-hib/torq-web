<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class numberPlateAddController extends Controller
{
    public function insert(Request $request)
    {
        $type = $request->input('type');
        $number = $request->input('number');
        $price = $request->input('price');
        $contact = $request->input('contact');
        $city = $request->input('city');
        $user_id = $request->input('user_id');
        $ldate = date('Y-m-d H:i:s');
        $data = array(
            "type" => $type, "num" => $number, "price" => $price, "contact" => $contact, "city" => $city, "user_id" => $user_id, "created_at" => $ldate

        );
        $insert = DB::table('numberPlate')->insert($data);
        return response()->json("Added Successfully");
    }
    public function fetchDetails()
    {

        $user = DB::select('select * from numberPlate ORDER BY created_at DESC');
        return response()->json($user);
    }
    public function fetchDetails1($user)
    {


        return response()->json(DB::select('SELECT * FROM  `numberPlate` WHERE `user_id`=?', [$user]));
    }
    public function fetchNumberPlates()
    {
        $user = DB::select('SELECT * from numberPlate ORDER BY created_at DESC LIMIT 3');
        return response()->json($user);
    }
}
