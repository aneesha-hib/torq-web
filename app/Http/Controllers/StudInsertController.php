<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudInsertController extends Controller
{
    public function insert(Request $request){
        $student_name = $request->input('student_name');
        $student_class = $request->input('student_class');
        $student_phone = $request->input('student_phone');
        $student_email = $request->input('student_email');
        $data=array('student_name'=>$student_name,"student_class"=>$student_class,"student_phone"=>$student_phone,"student_email"=>$student_email);
        Student::table('students')->insert($data);
        echo "Record inserted successfully.<br/>";
        echo '<a href = "/insert">Click Here</a> to go back.';
        }
}
