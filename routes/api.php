<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
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
Route::delete('delete_property', [CrudController::class,'Delete_Property']);
Route::put('updata_propert',[CrudController::class,'Update_Property']);
Route::post('index_property',[CrudController::class,'Index_Property']);
////////////property image crud////////////////////////////////////////////////////////
Route::post('addImage', [CrudController::class,'Add_Property_Image']);
Route::post('getimage', [CrudController::class,'Get_Property_Images']);
Route::delete('deletePropertyImage', [CrudController::class,'Remove_Property_Image']);
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
