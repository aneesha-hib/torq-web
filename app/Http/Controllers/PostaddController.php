<?php

namespace App\Http\Controllers;

use App\postadd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PostaddController extends Controller
{
    public function postadding(Request $request){
        $make = $request->input('make');
        $model = $request->input('model');
        $trim = $request->input('trim');
        $year = $request->input('year');
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
        $date = date('Y-m-d H:i:s');
        $user_type=$request->input('company_name');
        $status='0';

        $data=array(
            'make'=>$make,"model"=>$model,"trim"=>$trim,"year"=>$year,"mileage"=>$mileage,"engine_size"=>$engine_size,"drive_terrain"=>$drive_terrain,
            "transmission"=>$transmission,"fuel_type"=>$fuel_type,"condition1"=>$condition,"price"=>$price,"contact"=>$contact,"city"=>$city,"title"=>$title,
            "description"=>$description,
            "image"=>$image,"image2"=>$image2,"image3"=>$image3,"image4"=>$image4,"image5"=>$image5,"image6"=>$image6,"image7"=>$image7,"image8"=>$image8,
            "vehicleType"=>$vehicleType,
            "user_id"=>$user_id,"status"=>$status,"created_at"=>$date,"user_type"=>$user_type);
        $insert=DB::table('postadds')->insert($data);
        return response()->json("Successfully Registered",200);
    }
    public function fetchpostAdd($param1)
    {
        $user = DB::select('select * from postadds where vehicleType = ? ', [$param1]);
        return response()->json($user);
    }
    public function fetchUserpostAdd($param1)
    {
        $user = DB::select('select * from postadds where user_id = ? ', [$param1]);
        return response()->json($user);
    }
    public function fetchRecentlyAddedList()
    {
        $user = DB::select('SELECT created_at, image,price,vehicleType,postadd_id AS id,contact,make AS type,model AS make,year,mileage,user_type FROM postadds
        UNION ALL
        SELECT created_at, image,price,vehicleType,postvan_id AS id,contact,make AS type,model AS make,year,mileage,user_type  FROM postvans
        UNION ALL
        SELECT created_at, image,price,vehicleType,postbike_id AS id,contact,make AS type,model AS make,year,mileage,user_type  FROM postbikes
        UNION ALL
        SELECT created_at, image,price,vehicleType,postboat_id AS id,contact,type,make , year, mileage,user_type FROM postboats
        ORDER BY created_at DESC
        LIMIT 3');
        return response()->json($user);
    }
    public function fetchRecentlyAddedList1()
    {
        $user = DB::select('SELECT created_at, image,price,vehicleType,postadd_id AS id,contact,make AS type,model AS make FROM postadds
        UNION ALL
        SELECT created_at, image,price,vehicleType,postvan_id AS id,contact,make AS type,model AS make  FROM postvans
        UNION ALL
        SELECT created_at, image,price,vehicleType,postbike_id AS id,contact,make AS type,model AS make  FROM postbikes
        UNION ALL
        SELECT created_at, image,price,vehicleType,postboat_id AS id,contact,type,make  FROM postboats
        ORDER BY created_at DESC
        LIMIT 9');
        return response()->json($user);
    }
    public function fetchFavpostAdd($post_id,$vehicleType)
    {
        $user = DB::select('select * from postadds where postadd_id = ? and vehicleType=?', [$post_id,$vehicleType]);
        return response()->json($user);
    }
    public function fetchAdds()
    {
        $user = DB::select('select * from images where status=1 ');

        $date = date('Y-m-d');
        $ldate = date('Y-m-d',strtotime('-1 days'));
        DB::delete("DELETE from `postadds` WHERE `status`=? AND `updated_at`=?",['2',$date]);
        DB::delete("DELETE from `postbikes` WHERE `status`=? AND `updated_at`=?",['2',$date]);
        DB::delete("DELETE from `postboats` WHERE `status`=? AND `updated_at`=?",['2',$date]);
        DB::delete("DELETE from `postvans` WHERE `status`=? AND `updated_at`=?",['2',$date]);
        DB::delete("DELETE from `vehicle_scrap` WHERE `status`=? AND `updated_at`=?",['2',$date]);
        DB::update("Update images set status=? where starting_date=?",['1',$date]);
        DB::update("Update images set status=? where ending_date=?",['0',$ldate]);
        return response()->json($user);
    }
    public function editpost(Request $request){
        $id=$request->input('id');
        $make = $request->input('make');
        $model = $request->input('model');
        $trim = $request->input('trim');
        $year = $request->input('year');
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

        $user1 = DB::update('UPDATE `postadds` SET
        `make`=?,
        `model`=?,
        `trim`=?,
        `year`=?,
        `mileage`=?,
        `engine_size`=?,`drive_terrain`=?,`transmission`=?,
        `fuel_type`=?,`condition1`=?,`price`=?,`contact`=?,`city`=?,`title`=?,`description`=?,`image`=?,`image2`=?,`image3`=?,`image4`=?,`image5`=?,`image6`=?,
        `image7`=?,`image8`=?,`vehicleType`=?,`user_id`=? WHERE `postadd_id`=?', [$make,$model,$trim,$year,$mileage,$engine_size,$drive_terrain,$transmission,$fuel_type,$condition,$price,$contact,$city,$title,$description,$image
         ,$image2,$image3,$image4,$image5,$image6,$image7,$image8,$vehicleType,$user_id,$id]);
        return response()->json("Updated Successfully");

    }
    public function deletepost(Request $request)
    {
        $id=$request->input('id');
        $user=DB::delete('DELETE FROM `postadds`
         WHERE `postadd_id` = ?',[$id]);
        return response()->json("Deleted Successfully");
    }
    public function fetchSoldItems($user){
        $user1 = DB::select('select * from postadds where user_id = ? and status=?', [$user,'2']);
        return response()->json($user1);
    }
    public function soldItems(Request $request){
        $id=$request->input('id');
        $ldate = date('Y-m-d',strtotime('+3 days'));
        DB::update('update postadds set status = 2,updated_at=? where postadd_id = ?', [$ldate,$id]);
        return  response()->json("Move to Sold Items");
    }
    public function fetchIndividual($id,$vehicleType){
        $postadd=DB::select('select * from postadds where postadd_id = ? and vehicleType=?', [$id,$vehicleType]);
        return response()->json($postadd);
    }
    public function fetchCompany($company_name){
        $company=DB::select('select  logo from company where company_type = ? and company_name=? Limit 1', ['company',$company_name]);
        return response()->json($company);
    }
    public function companyBasedAdds($user_type)
    {
        $user = DB::select('SELECT user_type, image,price,vehicleType,postadd_id AS id,contact,make AS type,model AS make FROM postadds  where user_type=?
        UNION ALL
        SELECT user_type, image,price,vehicleType,postvan_id AS id,contact,make AS type,model AS make  FROM postvans  where user_type=?
        UNION ALL
        SELECT user_type, image,price,vehicleType,postbike_id AS id,contact,make AS type,model AS make  FROM postbikes  where user_type=?
        UNION ALL
        SELECT user_type, image,price,vehicleType,postboat_id AS id,contact,type,make  FROM postboats  where user_type=?',[$user_type,$user_type,$user_type,$user_type]);
        return response()->json($user);
    }

}
