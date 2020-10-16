<?php

namespace App\Http\Controllers;

use App\postadd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function chatposting(Request $request)
    {
        $sender_id = $request->input('sender_id');
        $user_id = $request->input('user_id');
        $uploadImage = $request->input('img');
        $message = $request->input('message');

        $product_id = $request->input('product_id');
        $vehicleType = $request->input('vehicleType');

        // date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d');
        $time = date('h:i a');


        $res=DB::insert(
            'INSERT INTO `chat`(`sender_id`, `client_id`, `message`,`date`, `time`,`status`,`images`,`product_id`,`vehicleType`) VALUES (?,?,?,?,?,?,?,?,?)',
            [$sender_id, $user_id, $message, $date, $time, '0',$uploadImage,$product_id,$vehicleType]
        );
        // $insert=DB::table('chat')->insert($data);
        return response()->json($res);
    }
    public function fetchMessages($user, $user_id,$product_id,$vehicleType)
    {

        $deleteQuery = "DELETE  from chat where  (Select COUNT(message) from chat where  ( `sender_id`=? AND `client_id`=? ) OR (`client_id`=? AND `sender_id`=? )) > 100 AND
      ( ( `sender_id`=? AND `client_id`=? ) OR (`client_id`=? AND `sender_id`=? ))  LIMIT 5";
        DB::delete($deleteQuery, [$user, $user_id, $user, $user_id, $user, $user_id, $user, $user_id]);
        $Contactid = DB::select(
            'SELECT * FROM `chat` WHERE ( `sender_id`=? AND `client_id`=? AND `product_id`=? AND `vehicleType`=? ) OR (`client_id`=? AND `sender_id`=? AND `product_id`=? AND `vehicleType`=?)',
            [$user, $user_id,$product_id,$vehicleType, $user, $user_id,$product_id,$vehicleType]
        );

        return response()->json($Contactid);
    }
    public function fetchContactList($user)
    {
        $res = DB::select('SELECT distinct  user_signups.user_id,user_signups.first_name,user_signups.last_name,user_signups.ProfileImage,
        chat.client_id,chat.sender_id from user_signups  JOIN  chat ON user_signups.user_id= chat.sender_id  where chat.client_id=?   ORDER by chat.chat_id DESC', [$user]);
        return response()->json($res);
    }
    public function fetchReadStatus($user_id)
    {
        $res = DB::select('SELECT distinct sender_id FROM `chat` where client_id=? and status=?', [$user_id, '0']);
        return response()->json($res);
    }
    public function setReadStatus($sender_id, $client_id)
    {
        $res = DB::update('UPDATE  chat set status=? where sender_id=? and client_id=?', ['1', $sender_id, $client_id]);
        return response()->json($res);
    }
    public function fetchNotificationStatus($client_id)
    {
        $res = DB::select('SELECT  COUNT(distinct sender_id) AS count FROM `chat` where client_id=? and status=?', [$client_id, '0']);
        return response()->json($res);
    }
    public function fetchNotification()
    {
        $res=DB::select('select user_signups.ProfileImage, user_signups.first_name,user_signups.last_name,postadds.vehicleType as Type, postadds.created_at ,postadds.user_type from user_signups inner join postadds on user_signups.user_id=postadds.user_id
        UNION ALL
        select user_signups.ProfileImage, user_signups.first_name,user_signups.last_name,postbikes.vehicleType as Type, postbikes.created_at , postbikes.user_type from user_signups inner join postbikes on user_signups.user_id=postbikes.user_id
        UNION ALL
        select user_signups.ProfileImage, user_signups.first_name,user_signups.last_name,postboats.vehicleType as Type, postboats.created_at , postboats.user_type from user_signups inner join postboats on user_signups.user_id=postboats.user_id
        UNION ALL
        select user_signups.ProfileImage, user_signups.first_name,user_signups.last_name,postvans.vehicleType as Type, postvans.created_at, postvans.user_type from user_signups inner join postvans on user_signups.user_id=postvans.user_id
        order by created_at DESC limit 10');
        return response()->json($res);
    }
    public function fetchProductView($user,$sender_id)
    {
        $res = DB::select('SELECT DISTINCT  postadds.postadd_id as id,postadds.vehicleType,postadds.image,postadds.price,postadds.make from postadds  JOIN  chat
        ON postadds.postadd_id= chat.product_id where  chat.client_id=? AND chat.sender_id=?
        UNION ALL
        SELECT DISTINCT  postbikes.postbike_id as id,postbikes.vehicleType,postbikes.image,postbikes.price,postbikes.make from postbikes  JOIN  chat
        ON postbikes.postbike_id= chat.product_id where  chat.client_id=? AND chat.sender_id=?
        UNION ALL
        SELECT DISTINCT  postboats.postboat_id as id,postboats.vehicleType,postboats.image,postboats.price,postboats.make from postboats  JOIN  chat
        ON postboats.postboat_id= chat.product_id where  chat.client_id=? AND chat.sender_id=?
        UNION ALL
        SELECT DISTINCT  postvans.postvan_id as id,postvans.vehicleType,postvans.image,postvans.price,postvans.make from postvans  JOIN  chat
        ON postvans.postvan_id= chat.product_id where  chat.client_id=? AND chat.sender_id=?',
        [$user,$sender_id,$user,$sender_id,$user,$sender_id,$user,$sender_id]);
        return response()->json($res);
    }
}
