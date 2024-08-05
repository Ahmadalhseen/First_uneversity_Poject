<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
class AuthController extends Controller
{

    public function register(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'phone'=>'required',
        //     'password' => 'required|string|min:8',
        // ]);
        $user = new User;
            $user->f_name =$request->f_name;
            $user->l_name =$request->l_name;
            $user->email = $request->email;
            $user->phone=$request->phone;
            $user->password = Hash::make($request->password);
            $user->api_token = Str::random(60);
            $user->save();
        return response()->json(['user' => $user], 201);
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            $user = Auth::user();

            $token = $user->createToken('Personal Access Token')->accessToken;
            return response()->json([
                'token' => $token,
                'user_type' => $user->user_type,
                'user_id'=>$user->id,
                'user'=>$user,
            ],201);
        } else {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }
    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->api_token = null;
        $user->save();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

}
