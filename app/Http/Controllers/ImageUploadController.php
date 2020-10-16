<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request){

        if($request->hasFile('photo'))
        {
            $filenameWithExt=$request->file('photo')->getClientOriginalName();
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension=$request->file('photo')->getClientOriginalExtension();
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            $path=$request->file('photo')->storeAs('public/images',$fileNameToStore);

        }
        else
        {
            $fileNameToStore='noimage.jpg';
        }


        $data=array("image_path"=>$fileNameToStore);
        $insert=DB::table('image_uploads')->insert($data);
		// $MESSAGE = "Image Uploaded Successfully." ;

		// Printing response message on screen after successfully inserting the image .
        return response()->json($fileNameToStore);

    }
}

