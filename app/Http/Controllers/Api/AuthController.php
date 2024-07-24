<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //regristration seller request validation
    public function registerSeller(Request $request)
    {
        //request validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|string",
            "phone" => "required|string",
            "address" => "required|string",
            "country" => "required|string",
            "province" => "required|string",
            "city" => "required|string",
            "district" => "required|string",
            "postal_code" => "required|string",
            "roles" => "required|string",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('assets/user','public');
        }

        //create user
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "phone" => $request->phone,
            "address" => $request->address,
            "country" => $request->country,
            "province" => $request->province,
            "city" => $request->city,
            "roles" => "seller",
            "postal_code" => $request->postal_code,
            "image" => $image,
        ]);

        //generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        //return response
        return response()->json([
            'status' => "success",
            'message' => "User created successfully",
            'data' => [
                'user' => $user,
            ],
        ], 201);
    }

    //login
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|string",
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => "error",
                'message' => "Invalid credentials",
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => "success",
            'message' => "Login successful",
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
        ], 200);
    }

    //logout
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => "success",
            'message' => "Logout successful",
        ], 200);
    }


    //register buyer
    public function registerBuyer(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            "email" => "required|email|unique:users,email",
            "password" => "required|string",
        ]);

        //create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //return response
        return response()->json([
            'status' => "success",
            'message' => "User Registered",
            'data' => $user,
        ], 200);

    }
}
