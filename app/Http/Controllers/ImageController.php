<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{


    public function fetchimage($param1)
    {
        $user = DB::select('select * from images where image_text = ?', [$param1]);
        return response()->json($user);
    }

}
