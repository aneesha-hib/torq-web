<?php

namespace App\Http\Controllers;

use App\UserSignup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserSignupController extends Controller
{
    public function insert(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $code = $request->input('code');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        $date = date('Y-m-d H:i:s');
        $profileImage = "https://firebasestorage.googleapis.com/v0/b/torq-88876.appspot.com/o/ProfileIcon.png?alt=media&token=05ba71fa-5450-4873-91a4-05dd8db34701";
        $flag = 0;
        $users = DB::select('SELECT * FROM user_signups where  phone = ? OR email =? ', [$phone, $email]);

        if ($users == null) {
            // $data = array(
            //     'first_name' => $first_name, "last_name" => $last_name, "code" => $code, "phone" => $phone, "email" => $email, "password" => $password,
            //     "confirm_password" => $confirm_password, "ProfileImage" => $profileImage
            // );
            //$insert = DB::table('user_signups')->insert($data);
            $res = DB::insert('INSERT INTO `user_signups`( `first_name`, `last_name`, `code`, `phone`, `email`, `password`, `confirm_password`, `ProfileImage`, `created_at`)
             VALUES (?,?,?,?,?,?,?,?,?)', [$first_name, $last_name, $code, $phone, $email, $password, $confirm_password, $profileImage, $date]);
            return response()->json("Successfully Registered");
        } else {
            return response()->json("Either phone number or Email already registered .");
        }
    }
    public function login(Request $request)
    {
        $phone = $request->input('phone');
        $password = $request->input('password');
        $users = DB::select('SELECT * FROM user_signups where ( phone = ? OR email =? ) AND password =?', [$phone, $phone, $password]);
        return response()->json($users);
    }
    public function updateProfilePic(Request $request)
    {
        $profileImage = $request->input('profileImage');
        $user_id = $request->input('user_id');
        $users = DB::update('update user_signups set ProfileImage =? where user_id = ?', [$profileImage, $user_id]);
        return response()->json($users);
    }
    public function updatePassword(Request $request)
    {
        $password = $request->input('password');
        $email = $request->input('email');
        $users = DB::update('update user_signups set password =?,confirm_password =? where email = ?', [$password, $password, $email]);
        return response()->json($users);
    }
    public function updateProfile(Request $request)
    {

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $user_id = $request->input('user_id');
        $changeMobile=$request->input('changeMobile');
        $changeEmail=$request->input('changeEmail');



        $user1 = DB::update('update user_signups set first_name =? ,last_name=?,phone=?,email=?,emailVerificationStatus=?,mobileVerificationStatus=? where user_id = ?',
         [$first_name, $last_name, $phone, $email, $changeEmail,$changeMobile,$user_id]);
         $user=DB::select('select * from user_signups where user_id = ?', [$user_id]);
        return response()->json($user);
    }
    public function setFavourite(Request $request)
    {
        $user_id = $request->input('user_id');
        $postAdd_id = $request->input('postadd_id');
        $users = DB::update('update user_signups set fav_post =? where user_id = ?', [$postAdd_id, $user_id]);
        return response()->json($users);
    }
    public function fetchName($user_id)
    {
        $users = DB::select('SELECT first_name,last_name FROM user_signups where user_id =?', [$user_id]);
        return response()->json($users);
    }
    public function fetchName1($email)
    {
        DB::update('update user_signups set emailVerificationStatus=1 where email=?', [$email]);
        return response()->json("Verified");
    }
    public function fetchemailStatus($email)
    {
        $users = DB::select('SELECT emailVerificationStatus FROM user_signups where email =?', [$email]);
        return response()->json($users);
    }
    public function fetchPhoneStatus($phone)
    {
        $users = DB::select('SELECT mobileVerificationStatus FROM user_signups where phone =?', [$phone]);
        return response()->json($users);
    }

    public function fetchmobileStatus($phone)
    {
        DB::update('update user_signups set mobileVerificationStatus=1 where phone=?', [$phone]);
        return response()->json("Verified");
    }
    public function Contactinsert(Request $request)
    {
        $first_name = $request->input('first_name');
        $company = $request->input('company');
        $email_id = $request->input('email_id');
        $phone_no = $request->input('phone_no');
        $request_type = $request->input('request_type');
        $message1 = $request->input('message');

        $to_name = "Admin";
        $to_email = "info@torq.qa";
        $subject = "Contact";
        $body = "";
        $image = $request->input('image');
        $vehicle_type = $request->input('vehicleType');
        $data = array(

            "first_name" => $first_name,
            "company" => $company,
            "email_id" => $email_id,
            "phone_no" => $phone_no,
            "request_type" => $request_type,
            "message1" => $message1);
        $res=Mail::send("contact", $data, function ($message) use ($to_name, $to_email, $subject) {
            $message->to($to_email, $to_name)
                ->subject($subject);
            $message->from("no-reply@torq.qa", "TorQ");
        });
        return response()->json($res);

    }
}
