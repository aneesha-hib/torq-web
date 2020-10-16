<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactInformationController extends Controller
{
    public function insert(Request $request)
    {
        $contact_person=$request->input('contact_person');
        $contact_email=$request->input('contact_email');
        $contact_no=$request->input('contact_no');
        $ldate = date('Y-m-d H:i:s');
        DB::insert('INSERT INTO `contact_information`(`name`, `emailAddress`, `phone`, `created_at`) VALUES (?,?,?,?)', [$contact_person,$contact_email,$contact_no,$ldate]);
        $Contactid=DB::select('SELECT * FROM `contact_information` WHERE  `name`=? AND `emailAddress`=? AND `phone`=?', [$contact_person,$contact_email,$contact_no]);
        return response()->json($Contactid);
    }
}
