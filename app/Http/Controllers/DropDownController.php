<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DropDownController extends Controller
{
    public function fetchmake($vehicleType)
    {
        $users = DB::select('SELECT * FROM make_tbl where cat_name=?', [$vehicleType]);
        return response()->json($users);
    }
    public function fetchmodel($make,$cat)
    {
        $users = DB::select('SELECT * FROM model_tbl where make_name=? and cat_name=?', [$make,$cat]);
        return response()->json($users);
    }
    public function fetchType($vehicle)
    {
        $users = DB::select('SELECT * FROM type_tbl where cat_name=?', [$vehicle]);
        return response()->json($users);
    }
}
