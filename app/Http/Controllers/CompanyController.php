<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function insert(Request $request)
    {
        $company_name=$request->input('company_name');
        $street1=$request->input('street1');
        $street2=$request->input('street2');
        $pincode=$request->input('pincode');
        $city=$request->input('city');
        $Qatar=$request->input('Qatar');
        $website=$request->input('website');
        $emailAddress=$request->input('emailAddress');
        $facebook=$request->input('facebook');
        $instagram=$request->input('instagram');
        $twitter=$request->input('twitter');
        $logo=$request->input('logo');
        $telephone=$request->input('telephone');
        $mobile=$request->input('mobile');
        $fax=$request->input('fax');
        $contact_id=$request->input('contact_id');
        $company_type=$request->input('company_type');
        $ldate = date('Y-m-d H:i:s');
        $data=array(
            'company_name'=>$company_name,"street1"=>$street1,"street2"=>$street2,"pincode"=>$pincode,"city"=>$city,"Qatar"=>$Qatar,"website"=>$website,
            "emailAddress"=>$emailAddress,"facebook"=>$facebook,"instagram"=>$instagram,"twitter"=>$twitter,"logo"=>$logo,"telephone"=>$telephone,"mobile"=>$mobile,
            "fax"=>$fax,
            "contact_id"=>$contact_id,"company_type"=>$company_type,"created_at"=>$ldate);
        $insert=DB::table('company')->insert($data);
        return response()->json('inserted Successfully');
    }
    public function fetchCompanyList($contact_id)
    {
        $user = DB::select('select * from company where contact_id = ? ', [$contact_id]);
        return response()->json($user);
    }
    public function fetchBrandBasedCompanies($brand_name)
    {
        $result=DB::select('SELECT * from company INNER JOIN brand_company inner join directorypost
        where company.contact_id=brand_company.contact_id AND company.contact_id=directorypost.contact_id AND brand_company.brand_name=? ', [$brand_name]);
        return response()->json($result);
    }
    public function fetchCategoryBasedCompanies($category_name)
    {
        $result=DB::select('SELECT * from company INNER JOIN category_company inner join directorypost
        where company.contact_id=category_company.contact_id AND company.contact_id=directorypost.contact_id AND category_company.category_name=? ', [$category_name]);
        return response()->json($result);
    }
    public function fetchClassifiedAddedPost()
    {
        $result=DB::select('SELECT * from company INNER JOIN directorypost
         where company.contact_id=directorypost.contact_id and company.company_type=? ORDER by directorypost.created_at DESC LIMIT 3',['company']);
        return response()->json($result);
    }
    public function fetchClassifiedAddedPost1()
    {
        $result=DB::select('SELECT * from company INNER JOIN directorypost
         where company.contact_id=directorypost.contact_id and company.company_type=? ORDER by directorypost.created_at DESC',['company']);
        return response()->json($result);
    }
    public function fetchcompanies(){
        $res=DB::select('SELECT * from company INNER JOIN directorypost WHERE company.contact_id=directorypost.contact_id');
        return response()->json($res);
    }
    public function fetchCompanyBySearch($company_name)
    {
        $result=DB::select('SELECT * from company INNER JOIN  directorypost
        where  company.contact_id=directorypost.contact_id AND company.company_name=? ', [$company_name]);
        return response()->json($result);
    }
    public function fetchBranchBasedCompanies($contact_id)
    {
        $result=DB::select('SELECT * from company
        where contact_id= ? AND company_type=? ', [$contact_id,'branch']);
       return response()->json($result);

    }
    public function editpost_company(Request $request){
        $company_id=$request->input('id');
        $company_name=$request->input('company_name');
        $street1=$request->input('street1');
        $street2=$request->input('street2');
        $pincode=$request->input('pincode');
        $city=$request->input('city');
        $Qatar=$request->input('Qatar');
        $website=$request->input('website');
        $emailAddress=$request->input('emailAddress');
        $facebook=$request->input('facebook');
        $instagram=$request->input('instagram');
        $twitter=$request->input('twitter');
        $logo=$request->input('logo');
        $telephone=$request->input('telephone');
        $mobile=$request->input('mobile');
        $fax=$request->input('fax');

        $user1 = DB::update('UPDATE `company` SET
        `company_name`=?,
        `street1`=?,
        `street2`=?,
        `pincode`=?,
        `city`=?,
        `Qatar`=?,`website`=?,`emailAddress`=?,
        `facebook`=?,`instagram`=?,`twitter`=?,`logo`=?,`telephone`=?,`mobile`=?,`fax`=?
         WHERE `company_id`=?', [$company_name,$street1,$street2,$pincode,$city,$Qatar,$website,$emailAddress,$facebook,$instagram,$twitter,$logo,$telephone,$mobile,$fax,$company_id
         ]);
        return response()->json($user1);

    }

}
