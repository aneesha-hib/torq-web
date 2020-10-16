<?php

use App\Http\Controllers\sendingmail;
use App\Http\Controllers\UserSignupController;
use App\Http\Controllers\VehicleScrapController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('SignUp','UserSignupController@insert');
Route::post('SignIn','UserSignupController@login');
Route::post('UpdateProfile','UserSignupController@updateProfile');
Route::post('uploadProfileImage','UserSignupController@updateProfilePic');
Route::post('imageUpload','ImageUploadController@uploadImage');
Route::get('image/{param1}','ImageController@fetchImage');
Route::get('postAddDetails/{param1}','PostaddController@fetchpostAdd');
Route::get('postAddDetailsVan/{param1}','PostaddVanController@fetchpostAddVan');
Route::get('postAddDetailsBike/{param1}','PostaddBikeController@fetchpostAddBike');
Route::get('postAddDetailsBoat/{param1}','PostaddBoatController@fetchpostAddBoat');
Route::get('UserpostAddDetails/{param1}','PostaddController@fetchUserpostAdd');
Route::get('FavpostAddDetails/{post_id}/{cat}','PostaddController@fetchFavpostAdd');
Route::get('UserpostAddDetailsBoat/{param1}','PostaddBoatController@fetchUserpostAddBoat');
Route::get('UserpostAddDetailsVan/{param1}','PostaddVanController@fetchUserpostAddVan');
Route::get('UserpostAddDetailsBike/{param1}','PostaddBikeController@fetchUserpostAddBike');
Route::get('fetchRecentlyAddedPost','PostaddController@fetchRecentlyAddedList');
Route::get('fetchRecentlyAddedPost1','PostaddController@fetchRecentlyAddedList1');
Route::post('addpost','PostaddController@postadding');
Route::post('InsertPostAddVan','PostAddVanController@insert');
Route::post('InsertPostAddBike','PostAddBikeController@insert');
Route::post('InsertPostAddBoat','PostAddBoatController@insert');
Route::post('InsertVehicleScrap','VehicleScrapController@insert');
Route::post('editpost','PostaddController@editpost');
Route::post('editvanpost','PostaddVanController@editpost');
Route::post('editbikepost','PostAddBikeController@editpost');
Route::post('editboatpost','PostAddBoatController@editpost');
Route::post('editscrappost', 'VehicleScrapController@editpost');
Route::post('deletepost', 'PostaddController@deletepost');
Route::post('deletevanpost', 'PostaddVanController@deletepost');
Route::post('deletebikepost', 'PostaddBikeController@deletepost');
Route::post('deleteboatpost', 'PostaddBoatController@deletepost');
Route::post('deletescrappost', 'VehicleScrapController@deletepost');
Route::post('InsertFavourite','FavouriteController@insert');
Route::post('sendmail', 'sendingmail@sendEmail');
Route::post('InsertReportad', 'sendingmail@sendReportEmail');
Route::post('changePassword', 'UserSignupController@updatePassword');
Route::get('fetchFav/{user1}','FavouriteController@fetchfav');
Route::get('fetchBoatFav/{user1}','FavouriteController@fetchBoatfav');
Route::get('fetchBikeFav/{user1}','FavouriteController@fetchBikefav');
Route::get('fetchVanFav/{user1}','FavouriteController@fetchVanfav');
Route::get('fetchScrapFav/{user1}','FavouriteController@fetchScrapfav');
Route::get('Adds','PostaddController@fetchAdds');
Route::get('Make/{vehicleType}','DropDownController@fetchmake');
Route::get('Model/{make}/{cat}','DropDownController@fetchmodel');
Route::get('Type/{vehicleType}','DropDownController@fetchType');
Route::post('numberPlate','numberPlateAddController@insert');
Route::get('postAddDetailsNumberPlate','numberPlateAddController@fetchDetails');
Route::get('postAddDetailsNumberPlate1/{user}','numberPlateAddController@fetchDetails1');
Route::get('fetchNumberPlates','numberPlateAddController@fetchNumberPlates');

Route::get('postAddDetailsScrap','VehicleScrapController@fetchDetails');
Route::get('postAddDetailsScrap1/{user}','VehicleScrapController@fetchDetails1');
Route::post('setFavourite','UserSignupController@setFavourite');
Route::get('SoldItemsPostAdd/{user}','PostAddController@fetchSoldItems');
Route::get('SoldItemsPostAddBike/{user}','PostAddBikeController@fetchSoldItems');
Route::get('SoldItemsPostAddBoat/{user}','PostAddBoatController@fetchSoldItems');
Route::get('SoldItemsPostAddVan/{user}','PostAddVanController@fetchSoldItems');
Route::get('SoldItemsPostAddScrap/{user}','VehicleScrapController@fetchSoldItems');
Route::post('postaddSold','PostaddController@soldItems');
Route::post('postaddbikeSold','PostaddBikeController@soldItems');
Route::post('postaddboatSold','PostaddBoatController@soldItems');
Route::post('postaddvanSold','PostaddVanController@soldItems');
Route::post('postaddscrapSold','VehicleScrapController@soldItems');
Route::get('fetchpostAddDetailsIndividual/{id}/{vehicleType}','PostaddController@fetchIndividual');
Route::get('fetchpostAddBikeDetailsIndividual/{id}/{vehicleType}','PostaddBikeController@fetchIndividual');
Route::get('fetchpostAddBoatDetailsIndividual/{id}/{vehicleType}','PostaddBoatController@fetchIndividual');
Route::get('fetchpostAddVanDetailsIndividual/{id}/{vehicleType}','PostaddVanController@fetchIndividual');
Route::get('fetchpostAddScrapDetailsIndividual/{id}/{vehicleType}','PostaddScrapController@fetchIndividual');
Route::get('fetchName/{user_id}','UserSignupController@fetchName');
Route::get('fetchName1/{email}','UserSignupController@fetchName1');


Route::post('AddContactInformation','ContactInformationController@insert');
Route::post('AddCompany','CompanyController@insert');
Route::post('AddCategory','CategoryController@insert');
Route::post('AddBrand','BrandController@insert');
Route::post('AddDirectory','DirectoryController@insert');
Route::get('fetchCompanyList/{contact_id}','CompanyController@fetchCompanyList');
Route::get('fetchCategory','CategoryController@fetchCategory');
Route::get('fetchCategoryList/{contact_id}','CategoryController@fetchCategoryList');
Route::get('fetchCategories','CategoryController@fetchCategories');

Route::get('fetchBrand','BrandController@fetchBrand');
Route::get('fetchBrandList/{contact_id}','BrandController@fetchBrandList');
Route::get('fetchCompanyDetails/{directory_type}','DirectoryController@fetchDetails');
Route::get('fetchBranchDetails/{contact_id}','DirectoryController@fetchBranchDetails');
Route::get('fetchBrandBasedCompanies/{brand_name}','CompanyController@fetchBrandBasedCompanies');
Route::get('fetchCategoryBasedCompanies/{category_name}','CompanyController@fetchCategoryBasedCompanies');
Route::get('fetchClassifiedAddedPost','CompanyController@fetchClassifiedAddedPost');
Route::get('fetchClassifiedAddedPost1','CompanyController@fetchClassifiedAddedPost1');
Route::get('fetchVehicleBrands','BrandController@fetchVehicleBrands');
Route::get('fetchVehicleBrands1','BrandController@fetchVehicleBrands1');

Route::post('sendMessage','ChatController@chatposting');
Route::get('fetchMessages/{user}/{user_id}/{product_id}/{vehicleType}','ChatController@fetchMessages');
Route::get('fetchContactList/{user}','ChatController@fetchContactList');
Route::get('fetchReadStatus/{user_id}','ChatController@fetchReadStatus');
Route::get('SetReadStatus/{sender_id}/{client_id}','ChatController@setReadStatus');
Route::get('fetchcompanylogo/{user_type}','PostaddController@fetchCompany');
Route::get('fetchcompanyBoatlogo/{user_type}','PostAddBoatController@fetchCompany');
Route::get('fetchcompanyBikelogo/{user_type}','PostAddBikeController@fetchCompany');
Route::get('fetchcompanyVanlogo/{user_type}','PostAddVanController@fetchCompany');
Route::get('fetchCompanies','CompanyController@fetchcompanies');
Route::get('fetchCompanyBySearch/{company_name}','CompanyController@fetchCompanyBySearch');
Route::get('fetchNotificationStatus/{user_id}','ChatController@fetchNotificationStatus');
Route::get('fetchcompanyBranch/{contact_id}','CompanyController@fetchBranchBasedCompanies');
Route::get('fetchcompanyBasedAdds/{user_type}','PostaddController@companyBasedAdds');
Route::post('SendVerificationMail','sendingmail@sendVerificationEmail');
Route::get('fetchStatus/{email}','UserSignupController@fetchemailStatus');
Route::get('fetchStatusPhone/{phone}','UserSignupController@fetchPhoneStatus');
Route::get('phoneNumberVerification/{mobileNumber}','UserSignupController@fetchmobileStatus' );
Route::post('contactpost','UserSignupController@Contactinsert');
Route::post('AddMap','MapController@AddMap');
Route::get('fetchMapDetails/{contact_id}','MapController@fetchMapDetails');
Route::get('fetchMapDetails1/{directory}','MapController@fetchMapDetails1');
Route::get('fetchMapDetails2/{category}','MapController@fetchMapDetails2');
Route::post('fetchCompanyDetails_edit','CompanyController@editpost_company');
Route::get('Notification','ChatController@fetchNotification');
Route::get('fetchProductView/{user}/{sender_id}','ChatController@fetchProductView');
