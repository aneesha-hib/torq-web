<?php

use App\Http\Controllers\sendingmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    $to_name = 'Chanchal C Joy';
    $to_email = "chanchaljoy199@gmail.com";
    $data = array('name' => $to_name, 'body' => 'A test mail');
    Mail::send('mail', $data, function ($message) use ($to_name, $to_email) {
        $message->to($to_email)
            ->subject("Laravel Test Mail");
        $message->from("aneeshajenson27@gmail.com","TorQ");
    });
});
Route::post('SignUp','UserSignupController@insert');
Route::post('SignIn','UserSignupController@login');
Route::post('uploadProfileImage','UserSignupController@updateProfilePic');

Route::post('imageUpload','ImageUploadController@uploadImage');

Route::get('postAddDetails/{param1}','PostaddController@fetchpostAdd');
Route::get('postAddDetailsVan/{param1}','PostaddVanController@fetchpostAddVan');
Route::get('postAddDetailsBike/{param1}','PostaddBikeController@fetchpostAddBike');
Route::get('postAddDetailsBoat/{param1}','PostaddBoatController@fetchpostAddBoat');

Route::get('UserpostAddDetails/{param1}','PostaddController@fetchUserpostAdd');
Route::get('UserpostAddDetailsBoat/{param1}','PostaddBoatController@fetchUserpostAddBoat');
Route::get('UserpostAddDetailsVan/{param1}','PostaddVanController@fetchUserpostAddVan');
Route::get('UserpostAddDetailsBike/{param1}','PostaddBikeController@fetchUserpostAddBike');

Route::post('addpost','PostaddController@postadding');
Route::post('InsertPostAddVan','PostAddVanController@insert');
Route::post('InsertPostAddBike','PostAddBikeController@insert');
Route::post('InsertPostAddBoat','PostAddBoatController@insert');

Route::post('sendmail', 'sendingmail@sendEmail');
Route::post('changePassword', 'UserSignupController@updatePassword');
