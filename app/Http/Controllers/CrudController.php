<?php

namespace App\Http\Controllers;
/////////////////////model classes//////////////////////
use App\Models\Property;
use App\Models\Favorite;
use App\Models\property_multimedia;
use App\Models\Property_Location;
use App\Models\Property_Rate;
use App\Models\Appoitment;
use App\Models\user_address;
use App\Models\suggestion;
use App\Models\User;
/////////////////request classes////////////////////////
use Illuminate\Http\Request;
/////////////////////////////////////////////////////////
class CrudController extends Controller
{
    //////////////Property Crud//////////////////////////////////////

    public function Add_Property(Request $request)
{
    // تحقق من وجود صورة وتحميلها إذا كانت موجودة
    $imageUrl = '';
    if ($request->hasFile('main_image_url')) {
        $image = $request->file('main_image_url');
        $fileName = 'property_image_' . time() . '.' . $image->getClientOriginalExtension();
        $path = 'C:\xampp\htdocs\ملفات المشروع الفصلي\React_fille\React_Testing\Test\public';
        $image->move($path, $fileName);
        $imageUrl = $fileName;
    }

    // إنشاء عقار جديد وتعبئة البيانات
    $property = new Property();
    $property->area = $request->input('area');
    $property->bedroom = $request->input('bedroom');
    $property->bathroom = $request->input('bathroom');
    $property->location = $request->input('location');
    $property->direction = $request->input('direction');
    $property->view = $request->input('view');
    $property->condition = $request->input('condition');
    $property->grade = $request->input('grade');
    $property->main_image_url = $imageUrl;
    $property->sale_price = $request->sale_price; // حفظ رابط الصورة
    $property->user_id = $request->user_id;
    $property->save();
    // إعادة الاستجابة مع رسالة النجاح ورابط الصورة المرفوعة
    return response()->json([
        'message' => 'Property added successfully!',
        'property' => $property // إعادة كافة بيانات العقار المضافة مع رابط الصورة
    ], 201);
}

    public function Get_Poperty()  {
     $property=Property::all();
     return response()->json($property, 201,);
    }
    public function Update_Property(Request $request)
{
    // العثور على العقار الذي سيتم تحديثه
    $property = Property::find($request->id);

    if (!$property) {
        return response()->json(['error' => 'Property not found'], 404);
    }

    // إذا كانت هناك صورة جديدة في الطلب، قم بتحديثها
    if ($request->hasFile('main_image_url')) {
        $image = $request->file('main_image_url');
        $fileName = 'property_image_' . time() . '.' . $image->getClientOriginalExtension();
        $path = 'C:\xampp\htdocs\ملفات المشروع الفصلي\React_fille\React_Testing\Test\public';
        $image->move($path, $fileName);
        $imageUrl = $fileName;
    }
    // تحديث بيانات العقار وفقاً للحقول الجديدة
    $property->area = $request->input('area', $property->area);
    $property->bedroom = $request->input('bedroom', $property->bedroom);
    $property->bathroom = $request->input('bathroom', $property->bathroom);
    $property->location = $request->input('location', $property->location);
    $property->direction = $request->input('direction', $property->direction);
    $property->view = $request->input('view', $property->view);
    $property->condition = $request->input('condition', $property->condition);
    $property->grade = $request->input('grade', $property->grade);

    // حفظ التحديثات
    $property->save();

    return response()->json(['message' => 'Property updated successfully', 'property' => $property]);
}
    public function destroy(Request $data)
    {
        $property = Property::find($data->id);
        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        $property->delete();
        return response()->json(['message' => 'Property deleted'], 200);
    }
    public function Index_Property(Request $data){
    $property= Property::find($data->id);
    return response()->json(["property"=>$property],201);
    }
    ////////////////////////Property_images crud///////////////////////////
    public function storeMultimedia(Request $request)
    {
        // Ensure the 'image_url' key exists and contains multiple files
        if ($request->hasFile('image_url') && is_array($request->file('image_url'))) {
            foreach ($request->file('image_url') as $file) {
                if ($file) {
                    // Generate a unique filename for each image
                    $fileName = 'property_image_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Define the destination path
                    $destinationPath = 'C:\xampp\htdocs\ملفات المشروع الفصلي\React_fille\React_Testing\Test\public';

                    // Move the uploaded file to the desired destination
                    $file->move($destinationPath, $fileName);

                    // Create a new property_multimedia instance for each image
                    $multimedia = new property_multimedia();
                    $multimedia->image_url =   $fileName; // Set the image_url attribute
                    $multimedia->property_id = $request->property_id; // Set the property_id attribute
                    $multimedia->save(); // Save the instance to the database
                }
            }

            return response()->json(['message' => 'Images uploaded successfully'], 201);
        } else {
            return response()->json(['error' => 'No images were uploaded or invalid format'], 400);
        }
    }


    public function Get_property_multimedia(Request $request)
    {
        // Retrieve the first multimedia record that matches the property_id
        $multimedia = property_multimedia::where('property_id', $request->property_id )->get();

        if ($multimedia) {
            // Return the multimedia record as a JSON response
            return response()->json($multimedia, 200);
        } else {
            // Return an error response if no multimedia is found
            return response()->json(['error' => 'No multimedia found for this property.'], 404);
        }
    }

    public function Remove_property_multimedia(Request $data){
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

    $location->save();
    return response()->json(["Location Addedd succefully"], 201);
   }
   public function Get_Property_Location(Request $data) {
    $location=Property_Location::where('property_id',$data->p_id)->first();
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
   ////////////////////user Address crud////////////////////////////
   public function Add_User_Address(Request $data){
    $user_address= new user_address();
    $user_address->user_id=$data->user_id;
    $user_address->street_address=$data->street_address;
    $user_address->Postal_Code=$data->Postal_Code;
    $user_address->country=$data->country;
    $user_address->city=$data->city;
    $user_address->save();
   }
   public function Delete_User_Address(Request $data){
   $user_address=user_address::find($data->user_id);
   $user_address->delete();

   }
   ///////////////////////////////Favorite crud//////////////////////
   public function Add_Favorite_Property(Request $data){
   $favorite=new Favorite();
   $favorite->user_id=$data->user_id;
   $favorite->property_id=$data->property_id;
   $favorite->save();
   return response()->json(['message'=>"succefull add"], 200);
   }
   public function Remove_From_Favorite(Request $data){
   Favorite::where('user_id',$data->user_id)->where("property_id",$data->property_id)->delete();
   return response()->json(['message'=>"data Removed"], 200);
   }
   ////////////////////////sugession /////////////////////////////////
   public function suggestions_store(Request $request) {
    $suggestion = new suggestion();
    $suggestion->title = $request->input('title');
    $suggestion->content = $request->input('content');
    $suggestion->user_id = $request->input('user_id');

    // Save the suggestion to the database
    if ($suggestion->save()) {
        return response()->json($suggestion, 201);
    } else {
        return response()->json(['error' => 'Failed to save suggestion.'], 500);
    }
}
public function suggestions_index()
    {
        $suggestions = Suggestion::all();
        return response()->json($suggestions);
    }
    /////////////////////////////Appiontment////////////////////////////
    public function createAppointment(Request $data)
    {
        // Create a new appointment instance
        $appointment = new Appoitment();

        // Set attributes
        $appointment->user_id = $data->user_id;            // Ensure user_id is part of the data
        $appointment->property_id = $data->property_id;    // Ensure property_id is part of the data
        $appointment->date = $data->date;                  // Ensure date is part of the data
        $appointment->time = $data->time;                  // Set the time attribute
        $appointment->status = $data->status ?? 'Pending'; // Default to 'Pending' if status is not provided

        // Save the appointment to the database
        $appointment->save();

        return response()->json([
            'message' => 'Appointment created successfully',
            'appointment' => $appointment,
        ], 201);
    }
//////////////////////get_Users///////////////////////////////////////////
public function Get_User(){
    $Users=User::all();
    return response()->json($Users, 200);
}
public function toggleCanAdd(Request $request)
    {
        // Find the user by ID
        $user = User::find($request->id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Toggle the can_add field
        $user->can_add = $request->can_add;
        $user->save();

        return response()->json(['message' => 'User can_add status updated successfully'], 200);
    }
    public function getUserDetails(Request $request)
    {
        // Fetch the user by ID
        $user = User::where("id", $request->id)->first();

        if (!$user) {
            return response()->json(["error" => "User not found"], 404);
        }

        // Fetch all properties owned by the user
        $properties = Property::where("user_id", $user->id)->get();

        if ($properties->isEmpty()) {
            return response()->json(["user" => $user, "appointments" => []]);
        }

        // Get all property IDs for this user
        $propertyIds = $properties->pluck('id');

        // Fetch all appointments related to these properties
        $appointments = Appoitment::whereIn("property_id", $propertyIds)->get();

        // Return user data and associated appointments
        return response()->json(["user" => $user, "appointments" => $appointments]);
    }
    public function updateUserImage(Request $request)
{
    $user = User::find($request->id);

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    if ($request->hasFile('picture')) {
        $file = $request->file('picture');
        $filename = time() . '_' . $file->getClientOriginalName();
        $destinationPath = 'C:\xampp\htdocs\ملفات المشروع الفصلي\React_fille\React_Testing\Test\public\\';
        $file->move($destinationPath, $filename);

        // Update user record with new image path
        $user->picture = $filename;
        $user->save();

        return response()->json(['message' => 'Image uploaded successfully', 'user' => $user]);
    }

    return response()->json(['error' => 'No image uploaded'], 400);
}
///////////////////////////////////location_crud/////////////////////////////////
public function Property_Rating(Request $request)
{


    $rating= new Property_Rate();
    $rating->property_id=$request->property_id;
    $rating->user_id=$request->user_id;
    $rating->comment=$request->comment;
    $rating->max_rate=$request->max_rate;
    $rating->save();
    return response()->json(['message' => 'Rating submitted successfully!'], 201);
}
}
