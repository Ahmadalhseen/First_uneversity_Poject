<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\Property_Images;
use App\Models\Property_Location;
use App\Models\Property_Rate;
use Illuminate\Http\Request;
class CrudController extends Controller
{
    //////////////Property Crud//////////////////////////////////////
    public function Add_Property(Request $request){
    // $property=new Property;
    // $property->lot_rea=$data->lot_rea;
    // $property->overall_qual=$data->overall_qual;
    // $property->sale_price  =$data->sale_price  ;
    // $property->totrms_abvgrd =$data->totrms_abvgrd ;
    // $property->full_bath=$data->full_bath;
    // $property->year_built=$data->year_built;
    // $property->save();
    // return response()->json(["masseg"=>"create succeful"], 201 );

 // Validate the request

// Validate the request
$request->validate([
    'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    'lot_rea' => 'required|numeric',
    'overall_qual' => 'required|numeric',
    'sale_price' => 'required|numeric',
    'totrms_abvgrd' => 'required|numeric',
    'full_bath' => 'required|numeric',
    'year_built' => 'required|string',
]);

// Initialize variables
$imageUrl = '';

// Check if an image is uploaded
if ($request->hasFile('image_url')) {
    $image = $request->file('image_url');

    // Create a custom file name
    $fileName = 'property_image_' . time() . '.' . $image->getClientOriginalExtension();

    // Define the absolute path to the C disk directory
    $path = 'C:\xampp\htdocs\ملفات المشروع الفصلي\React_fille\React_Testing\MyProject33-master\public';

    // Ensure the directory exists


    // Move the image to the specified directory
    $image->move($path, $fileName);

    // Set the image URL to the absolute path
    $imageUrl = $fileName;
}

// Save property details to the database
$property = new Property();
$property->lot_rea = $request->input('lot_rea');
$property->overall_qual = $request->input('overall_qual');
$property->sale_price = $request->input('sale_price');
$property->totrms_abvgrd = $request->input('totrms_abvgrd');
$property->full_bath = $request->input('full_bath');
$property->year_built = $request->input('year_built');
$property->image_url = $imageUrl; // Save image URL
$property->save();

// Return a success response
return response()->json([
    'message' => 'Property added successfully!',
    'image_url' => $imageUrl // Return the URL of the uploaded image
], 201);
    }
    public function Get_Poperty()  {
     $property=Property::all();
     return response()->json($property, 201,);
    }
    public function Update_Property(Request $request) {
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $fileName = 'property_image_' . time() . '.' . $image->getClientOriginalExtension();
            $path = 'C:\xampp\htdocs\ملفات المشروع الفصلي\images';
            $image->move($path, $fileName);
            // Set the image URL to the absolute path
            $imageUrl = $path . '\\' . $fileName;
        }
        $property->lot_rea = $request->input('lot_rea');
        $property->overall_qual = $request->input('overall_qual');
        $property->sale_price = $request->input('sale_price');
        $property->totrms_abvgrd = $request->input('totrms_abvgrd');
        $property->full_bath = $request->input('full_bath');
        $property->year_built = $request->input('year_built');
        $property->image_url = $imageUrl; // Save image URL
        $property->save();
    }
    public function Delete_Property(Request $data)  {
     $property= Property::find($data->id);
     $property->delete();
    }
    public function Index_Property(Request $data){
    $property= Property::find($data->id);
    return response()->json($property,200);
    }
    ////////////////////////Property_images crud///////////////////////////
    public function Add_Property_Image(Request $data){
    $image=new Property_Images();
    $image->property_id=$data->property_id;
    $image->image_url=$data->image_url;
    $image->save();
    return  response()->json(["message"=>"succeful insert"], 201);
    }
    public function Get_Property_Images(Request $data){
        $image=Property::find($data->id)->Property_Images;
        return response()->json(["data"=>$image],200);
    }
    public function Remove_Property_Image(Request $data){
        $image= Property_Images::find($data->id);
        $image->delete();
        return  response()->json(["deleted succefully"], 200);
    }
   ///////////////////////Property Location crud////////////////////////
   public function Add_Property_Location(Request $data){
    $location =new Property_Location();
    $location->property_id=$data->property_id;
    $location->latitude =$data->latitude ;
    $location->longitude =$data->longitude;
    $location->city=$data->city;
    $location->country=$data->country;
    $location->save();
    return response()->json(["Location Addedd succefully"], 201);
   }
   public function Get_Property_Location(Request $data) {
    $location=Property_Location::where('id',$data->id)->get();
    return response()->json(["Location"=>$location], 201);
   }
   public function Delet_Poperty_Location(Request $data){
   $location=Property_Location::find($data->id);
   $location->delete();
   return response()->json(["messag"=>"deleted succefuly"], 201);
   }
   public function Update_Property_Location(Request $data)
   {
    $location=Property_Location::find($data->id);
    $location->latitude =$data->latitude ;
    $location->longitude =$data->longitude;
    $location->city=$data->city;
    $location->country=$data->country;
    $location->save();
    return response()->json(["messag"=>"deleted succefuly"], 201);
   }
   /////////////////Property Rate crude///////////////////////////
   public function Add_Property_rate(Request $data){
    $property_rate=new Property_Rate();
    $property_rate->max_rate=$data->max_rate;
    $property_rate->user_id=$data->user_id;
    $property_rate->property_id=$data->property_id;
    $property_rate->comment=$data->comment;
    $property_rate->save();
    return response()->json(["messag"=>"Added succefuly"], 201);
   }
   public function Delete_Property_Rate(Request $data){
    $property_rate=Property_Rate::find($data->id);
    $property->delete();

    return response()->json(["messag"=>"deleted succefuly"], 201);
   }
   public function Get_Property_Rates(Request $data){
    $property_rate=Property_Rate::all();
    return response()->json(["Rates"=>$property_rate], 201);
   }
   public function Update_Property_Rates(Request $data){
    $property_rate=Property_Rate::find($data->id);
    $property_rate->max_rate=$data->max_rate;
    $property_rate->comment=$data->comment;
    return response()->json(["Rates"=>$property_rate], 201);

   }
}
