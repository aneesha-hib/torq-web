<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavouriteController extends Controller
{
    public function insert(Request $request)
    {
        $post_id = $request->input('id');
        $user_id = $request->input('user_id');
        $vehicle_type = $request->input('vehicle_Type');
        $users = DB::select('SELECT * FROM favourite_post where  user_id = ? AND post_id =? ', [$user_id, $post_id]);

        if ($users == null) {
            $data = array(
                'post_id' => $post_id, "user_id" => $user_id, "vehicle_type" => $vehicle_type
            );
            $insert = DB::table('favourite_post')->insert($data);
            return response()->json("Added to your favourites");
        } else {
            return response()->json("Already added to favourites");
        }
    }
    public function fetchfav($user1)
    {


        $result=DB::select('SELECT * from
         favourite_post
         INNER JOIN
         postadds
         where
          favourite_post.post_id=postadds.postadd_id
          and favourite_post.user_id=?
          and (favourite_post.vehicle_type=?||favourite_post.vehicle_type=?)', [$user1,'car','suv']);
        return response()->json($result);
    }
    public function fetchBikefav($user1)
    {


        $result=DB::select('SELECT * from favourite_post INNER JOIN postbikes where favourite_post.post_id=postbikes.postbike_id and favourite_post.user_id=?
         and (favourite_post.vehicle_type=?||favourite_post.vehicle_type=?)', [$user1,'bike','classic']);
        return response()->json($result);
    }
    public function fetchBoatfav($user1)
    {


        $result=DB::select('SELECT * from favourite_post INNER JOIN postboats where favourite_post.post_id=postboats.postboat_id and favourite_post.user_id=?
        and (favourite_post.vehicle_type=?||favourite_post.vehicle_type=?||favourite_post.vehicle_type=?||favourite_post.vehicle_type=?)', [$user1,'boat','bicycle','heavy equipment','auto spare parts']);
        return response()->json($result);
    }
    public function fetchVanfav($user1)
    {


        $result=DB::select('SELECT * from favourite_post INNER JOIN postvans where favourite_post.post_id=postvans.postvan_id and favourite_post.user_id=?
        and (favourite_post.vehicle_type=?||favourite_post.vehicle_type=?||favourite_post.vehicle_type=?||favourite_post.vehicle_type=?)'
        , [$user1,'van','truck','bus','pickup']);
        return response()->json($result);
    }
    public function fetchScrapfav($user1)
    {


        $result=DB::select('SELECT * from favourite_post INNER JOIN vehicle_scrap where favourite_post.post_id=vehicle_scrap.scrap_id and favourite_post.user_id=?
        and (favourite_post.vehicle_type=?)'
        , [$user1,'scrap']);
        return response()->json($result);
    }
}
