<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostAddBikeController extends Controller
{

    public function insert(Request $request){
        $make = $request->input('make');
        $model = $request->input('model');
        $type = $request->input('type');
        $mileage=$request->input('mileage');
        $engine_size=$request->input('engine_size');
        $drive_terrain=$request->input('drive_terrain');
        $transmission=$request->input('transmission');
        $fuel_type=$request->input('fuel_type');
        $condition=$request->input('condition');
        $price=$request->input('price');
        $contact=$request->input('contact');
        $city=$request->input('city');
        $title=$request->input('title');
        $description=$request->input('description');
        $image = $request->input('image');
        $image2 = $request->input('image2');
        $image3 = $request->input('image3');
        $image4 = $request->input('image4');
        $image5 = $request->input('image5');
        $image6 = $request->input('image6');
        $image7 = $request->input('image7');
        $image8 = $request->input('image8');
        $vehicleType = $request->input('vehicleType');
        $user_id=$request->input('user_id');
        $ldate = date('Y-m-d H:i:s');
        $user_type=$request->input('company_name');
        $status='0';

        $data=array('make'=>$make,"model"=>$model,
        "type"=>$type,"mileage"=>$mileage,
        "engine_size"=>$engine_size,"drive_terrain"=>$drive_terrain,
        "transmission"=>$transmission,"fuel_type"=>$fuel_type,
        "condition1"=>$condition,"price"=>$price,
        "contact"=>$contact,"city"=>$city,
        "title"=>$title,"description"=>$description,
        "image"=>$image,"image2"=>$image2,
        "image3"=>$image3,"image4"=>$image4,
        "image5"=>$image5,"image6"=>$image6,
        "image7"=>$image7,"image8"=>$image8,
        "vehicleType"=>$vehicleType,
        "user_id"=>$user_id,
        "created_at"=>$ldate,"status"=>$status,"user_type"=>$user_type

    );
        $insert=DB::table('postbikes')->insert($data);
        return response()->json("Successfully Registered");


    }
    public function fetchpostAddBike($param1)
    {
        $user = DB::select('select * from postbikes where vehicleType = ? ', [$param1]);
        return response()->json($user);
    }
    public function fetchUserpostAddBike($param1)
    {
        $user = DB::select('select * from postbikes where user_id = ? ', [$param1]);
        return response()->json($user);
    }
    public function editpost(Request $request){
        $id=$request->input('id');
        $make = $request->input('make');
        $model = $request->input('model');
        $type = $request->input('type');
        $mileage=$request->input('mileage');
        $engine_size=$request->input('engine_size');
        $drive_terrain = $request->input('drive_terrain');
        $transmission = $request->input('transmission');
        $fuel_type = $request->input('fuel_type');
        $condition=$request->input('condition');
        $price=$request->input('price');
        $contact = $request->input('contact');
        $city = $request->input('city');
        $title = $request->input('title');
        $description=$request->input('description');
        $image=$request->input('image');
        $image2=$request->input('image2');
        $image3=$request->input('image3');
        $image4=$request->input('image4');
        $image5=$request->input('image5');
        $image6=$request->input('image6');
        $image7=$request->input('image7');
        $image8=$request->input('image8');
        $vehicleType=$request->input('vehicleType');
        $user_id=$request->input('user_id');

        $user1 = DB::update('UPDATE `postbikes` SET
        `make`=?,
        `model`=?,
        `type`=?,
        `mileage`=?,
        `engine_size`=?,`drive_terrain`=?,`transmission`=?,
        `fuel_type`=?,`condition1`=?,`price`=?,`contact`=?,`city`=?,`title`=?,`description`=?,`image`=?,`image2`=?,`image3`=?,`image4`=?,`image5`=?,`image6`=?,
        `image7`=?,`image8`=?,`vehicleType`=?,`user_id`=? WHERE `postbike_id`=?', [$make,$model,$type,$mileage,$engine_size,$drive_terrain,$transmission,$fuel_type,$condition,$price,$contact,$city,$title,$description,$image
         ,$image2,$image3,$image4,$image5,$image6,$image7,$image8,$vehicleType,$user_id,$id]);
        return response()->json("Updated Successfully");

    }
    public function deletepost(Request $request)
    {
        $id=$request->input('id');
        $user=DB::delete('DELETE FROM `postbikes`
         WHERE `postbike_id` = ?',[$id]);
        return response()->json("Deleted Successfully");
    }
    public function fetchSoldItems($user){
        $user1 = DB::select('select * from postbikes where user_id = ? and status=?', [$user,'2']);
        return response()->json($user1);
    }
    public function soldItems(Request $request){
        $id=$request->input('id');
        $ldate = date('Y-m-d',strtotime('+3 days'));
        DB::update('update postbikes set status = 2,updated_at=? where postbike_id = ?', [$ldate,$id]);
        return  response()->json("Move to Sold Items");
    }
    public function fetchIndividual($id,$vehicleType){
        $postadd=DB::select('select * from postbikes where postbike_id = ? and vehicleType=?', [$id,$vehicleType]);
        return response()->json($postadd);
    }
    public function fetchCompany($company_name){
        $company=DB::select('select  logo from company where company_type = ? and company_name=? Limit 1', ['company',$company_name]);
        return response()->json($company);
    }
}
