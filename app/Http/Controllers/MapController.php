<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function AddMap(Request $request){
        $company_name=$request->input('company_name');
        $latitude=$request->input('latitude');
        $longitude=$request->input('longitude');
        $place_name=$request->input('place_name');
        $res=DB::insert('INSERT INTO `map_info`(`company_name`, `latitude`, `longitude`, `place_name`)
        VALUES (?,?,?,?)', [$company_name,$latitude,$longitude,$place_name]);
        return response()->json($res);

    }
    public function fetchMapDetails($contact_id){
        $res=DB::select(' SELECT map_info.place_name,map_info.latitude,map_info.longitude from map_info inner JOIN company on company.company_name=map_info.company_name where company.contact_id=?', [$contact_id]);
        return response()->json($res);

    }
    public function fetchMapDetails1($directory){
        $res=DB::select(' SELECT map_info.place_name,map_info.latitude,map_info.longitude from map_info
        inner join directorypost
        inner join company
        on map_info.company_name=company.company_name
        where company.contact_id=directorypost.contact_id
        and directorypost.directory_type=?', [$directory]);
        return response()->json($res);

    }
    public function fetchMapDetails2($category){
        $res=DB::select(' SELECT map_info.place_name,map_info.latitude,map_info.longitude from map_info
        inner join category_company
        inner join company
        on map_info.company_name=company.company_name
        where company.contact_id=category_company.contact_id
        and category_company.category_name=?', [$category]);
        return response()->json($res);

    }
}