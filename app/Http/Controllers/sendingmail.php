<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class sendingmail extends Controller
{
    public function sendEmail(Request $request)
    {
        $to_name = "Customer";
        $to_email = $request->input("email");
        $subject = $request->input("subject");
        $body = $request->input("body");
        // $to_name = "Customer";
        // $to_email = "aneesha@woxro.com";
        // $subject = "Reset OTP";
        // $body = "OTP";

        $users =  DB::select('SELECT * FROM user_signups where email =? ', [$to_email]);
        // if ($users == null) {
        //     return response()->json(0);
        // } else {
            $data = array("name" => $to_name, "body" => $body);
            Mail::send("mail", $data, function ($message) use ($to_name, $to_email, $subject) {
                $message->to($to_email, $to_name)
                    ->subject($subject);
                $message->from("no-reply@torq.qa", "TorQ");
            });
            return  response()->json(1);
        // }



        // $to_name = "Customer";
        // $to_email = $request->input('mail');
        //  $subject = "Verification Mail";
        //  $body = $to_email;

        // // $users =  DB::select('SELECT * FROM user_signups where email =? ', [$to_email]);
        // // if ($users == null) {
        // //     return response()->json("no");
        // // } else {
        //     $data = array("name" => $to_name, "body" => $body);

        //     Mail::send("verificationMail", $data, function ($message) use ($to_name, $to_email, $subject) {
        //         $message->to($to_email, $to_name)
        //             ->subject($subject);
        //         $message->from("kroshniramakrishna@gmail.com", "TorQ");
        //     });
        //     return  response()->json("Mail send");
    }
    public function sendReportEmail(Request $request)
    {
        $user_id = $request->input("user_id");
        $postadd_id = $request->input('id');
        $make = $request->input('make');
        $model = $request->input('model');
        $user = $request->input('user');
        $phone = $request->input('phone');
        $to_name = "Admin";
        $to_email = "info@torq.qa";
        $subject = "subject";
        $body = "";
        $image = $request->input('image');
        $vehicle_type = $request->input('vehicleType');


        $data = array("name" => $to_name, "body" => $body, "image" => $image);
        Mail::send("mailAdmin", $data, function ($message) use ($to_name, $to_email, $subject) {
            $message->to($to_email, $to_name)
                ->subject($subject);
            $message->from("no-reply@torq.qa", "TorQ");
        });
        if ($vehicle_type == 'car' || $vehicle_type == 'suv') {
            DB::update('update postadds set status = 1 where postadd_id = ?', [$postadd_id]);
            return  response()->json("Mail send to Admin");
        } else if ($vehicle_type == 'bike' || $vehicle_type == 'classic') {
            DB::update('update postbikes set status = 1 where postbike_id = ?', [$postadd_id]);
            return  response()->json("Mail send to Admin");
        } else if ($vehicle_type == 'pickup' || $vehicle_type == 'van' || $vehicle_type == 'truck' || $vehicle_type == 'bus') {
            DB::update('update postvans set status = 1 where postbike_id = ?', [$postadd_id]);
            return  response()->json("Mail send to Admin");
        } else if ($vehicle_type == 'scrap') {
            DB::update('update vehicle_scrap set status = 1 where scrap_id = ?', [$postadd_id]);
            return  response()->json("Mail send to Admin");
        } else {
            DB::update('update postboats set status = 1 where postboat_id = ?', [$postadd_id]);
            return  response()->json("Mail send to Admin");
        }
    }
    public function sendVerificationEmail(Request $request)
    {
        $to_name = "Customer";
        $to_email = $request->input('mail');
         $subject = "Verification Mail";
         $body = $to_email;

        // $users =  DB::select('SELECT * FROM user_signups where email =? ', [$to_email]);
        // if ($users == null) {
        //     return response()->json("no");
        // } else {
            $data = array("name" => $to_name, "body" => $body);

            Mail::send("verificationMail", $data, function ($message) use ($to_name, $to_email, $subject) {
                $message->to($to_email, $to_name)
                    ->subject($subject);
                $message->from("no-reply@torq.qa", "TorQ");
            });
            return  response()->json("Mail send");
        // }
    }
}
