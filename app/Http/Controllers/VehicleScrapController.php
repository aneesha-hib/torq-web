<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleScrapController extends Controller
{
    public function insert(Request $request)
    {

        $price = $request->input('price');
        $contact = $request->input('contact');
        $city = $request->input('city');
        $title = $request->input('title');
        $description = $request->input('description');
        $image = $request->input('image');
        $image2 = $request->input('image2');
        $image3 = $request->input('image3');
        $image4 = $request->input('image4');
        $image5 = $request->input('image5');
        $image6 = $request->input('image6');
        $image7 = $request->input('image7');
        $image8 = $request->input('image8');

        $user_id = $request->input('user_id');
        $ldate = date('Y-m-d H:i:s');
        $status='0';
        $data = array(
            "price" => $price,
            "contact" => $contact,
            "city" => $city,
            "title" => $title,
            "description" => $description,
            "image1" => $image,
            "image2" => $image2,
            "image3" => $image3,
            "image4" => $image4,
            "image5" => $image5,
            "image6" => $image6,
            "image7" => $image7,
            "image8" => $image8,

            "user_id" => $user_id,
            "created_at"=>$ldate,
            "status"=>$status
        );

        $insert = DB::table('vehicle_scrap')->insert($data);
        return response()->json("Added Successfully", 200);
    }
    public function fetchDetails()
    {

            $user = DB::select('select * from vehicle_scrap');
            return response()->json($user);

    }
    public function fetchDetails1($user)
    {

            $user = DB::select('select * from vehicle_scrap where user_id=? ',[$user]);
            return response()->json($user);

    }
    public function deletepost(Request $request)
    {
        $id=$request->input('id');
        $user=DB::delete('DELETE FROM `vehicle_scrap`
         WHERE `scrap_id` = ?',[$id]);
        return response()->json("Deleted Successfully");
    }
    public function editpost(Request $request)
    {
        $id=$request->input('id');
        $price = $request->input('price');
        $contact = $request->input('contact');
        $city = $request->input('city');
        $title = $request->input('title');
        $description = $request->input('description');
        $image = $request->input('image1');
        $image2 = $request->input('image2');
        $image3 = $request->input('image3');
        $image4 = $request->input('image4');
        $image5 = $request->input('image5');
        $image6 = $request->input('image6');
        $image7 = $request->input('image7');
        $image8 = $request->input('image8');
        $vehicleType='scrap';
        $user1 = DB::update('UPDATE `vehicle_scrap` SET
         `price`=?,`contact`=?,`city`=?,`title`=?,`description`=?,
         `image1`=?,`image2`=?,`image3`=?,`image4`=?,`image5`=?,`image6`=?,`image7`=?,`image8`=?,vehicleType=? WHERE `scrap_id`=?',
         [$price,$contact,$city,$title,$description,$image
         ,$image2,$image3,$image4,$image5,$image6,$image7,$image8,$vehicleType,$id]);
        return response()->json("Updated Successfully");
    }
    public function fetchSoldItems($user){
        $user1 = DB::select('select * from vehicle_scrap where user_id = ? and status=?', [$user,'2']);
        return response()->json($user1);
    }
    public function soldItems(Request $request){
        $id=$request->input('id');
        $ldate = date('Y-m-d',strtotime('+3 days'));
        DB::update('update vehicle_scrap set status = 2,updated_at=? where scrap_id = ?', [$ldate,$id]);
        return  response()->json("Move to Sold Items");
    }
    public function fetchIndividual($id,$vehicleType){
        $postadd=DB::select('select * from vehicle_scrap where scrap_id = ? and vehicleType=?', [$id,$vehicleType]);
        return response()->json($postadd);
    }
}
