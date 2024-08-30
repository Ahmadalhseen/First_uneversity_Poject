<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PropertyStatisticsController;
use App\Http\Controllers\PropertyController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
/////////////////these is crud opration/////////////////////////////////////////////////
///////////Property Crud///////////////////////////////////////////////////////////////
Route::get('popertyInformation', [CrudController::class,'Get_Poperty']);
Route::post('add_property', [CrudController::class,'Add_Property']);
Route::delete('delete_property', [CrudController::class,'destroy']);
Route::put('updata_propert',[CrudController::class,'Update_Property']);
Route::post('index_property',[CrudController::class,'Index_Property']);
////////////property image crud////////////////////////////////////////////////////////
Route::post('addImage', [CrudController::class,'storeMultimedia']);
Route::post('getimage', [CrudController::class,'Get_property_multimedia']);
Route::delete('deletePropertyImage', [CrudController::class,'Remove_property_multimedia']);
////////////Poperty  Location crud /////////////////////////////////////////////////////////////////
Route::post('add_propperty_location',[CrudController::class,'Add_Property_Location']);
Route::post('get_propperty_location',[CrudController::class,'Get_Property_Location']);
Route::delete('delete_propperty_location',[CrudController::class,'Delete_Poperty_Location']);
Route::put('update_property_location',[CrudController::class,'Update_Property_Location']);
////////////Property Rates Crude////////////////////////////////////////////////////////////////////////
Route::post('add_propperty_Rate',[CrudController::class,'Add_Property_rate']);
Route::post('get_propperty_Rate',[CrudController::class,'Get_Property_Rates']);
Route::delete('delete_propperty_Rate',[CrudController::class,'Delete_Property_Rate']);
Route::post('update_property_Rate',[CrudController::class,'Update_Property_Location']);
/////////////////Favorite crud////////////////////////////////////////////////////////////////////////
Route::post('add_to_favorite',[CrudController::class,'Add_Favorite_Property']);
Route::delete('delete_from_favorite',[CrudController::class,'Remove_From_Favorite']);
///////////////////suggesion ///////////////////////////////////////////////////////////////////////
Route::post('add_suggesion', [CrudController::class,'suggestions_store']);
Route::get('get_suggestion', [CrudController::class,'suggestions_index']);
///////////////////////////Appiontment/////////////////////////////////////////////////
Route::post('createAppointment', [CrudController::class,'createAppointment']);
//////////////////////////payment Proccess/////////////////////////////////////////////
Route::post('PaymentProcess', [PaymentController::class,'processPayment']);
///////////////////////////get_user//////////////////////////////////////////////////
Route::get('get_user', [CrudController::class,'Get_User']);
Route::post('toggle-can-add', [CrudController::class, 'toggleCanAdd']);
Route::post('getUserDetails', [CrudController::class, 'getUserDetails']);
Route::post('updateUserImage',[CrudController::class, 'updateUserImage']);
//////////////////////////////////ManagerController/////////////////////////////
Route::get('getUserStatistics', [ManagerController::class,'getUserStatistics']);
Route::get('getPropertyStatistics', [PropertyStatisticsController::class,'getPropertyStatistics']);
Route::post('predict-price', [PropertyController::class, 'getPrice']);
//////////////////////////////////////////rating//////////////////////////////////////////
Route::post('Property_Rating', [CrudController::class, 'Property_Rating']);
