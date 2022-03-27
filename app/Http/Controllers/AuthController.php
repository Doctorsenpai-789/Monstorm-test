<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string|unique:users,phone_number',
            'password' => 'required|string|confirmed',
            'address' => 'required|string',
            'user_type' => 'required|string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'phone_number' => $fields['phone_number'],
            'password' => bcrypt($fields['password']),
            'address' => $fields['address'],
            'user_type' => $fields['user_type']
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'phone_number' => 'required',
            'password' => 'required'
        ]);

        // Check email
        $user = User::where('phone_number', $fields['phone_number'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    
    

    public function logout(Request $request)
    {
        // auth()->user()->tokens()->delete();

        // return [
        //     'message' => 'Logged out'
        // ];
        auth()->user()->tokens->each(function($token) {
            $token->delete();
        });
    
        return [
                 'message' => 'Logged out'
             ];
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id'=>'required',
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
       
       if ($validator->fails()){
            return response()->json([
                'message'=>'Validation fails',
                'errors'=>$validator->errors()
            ],422);
       }
    //   $user=$request->user();
       $user = User::find($request->user_id);
    //    dd($user);
       if(Hash::check($request->old_password,$user->password)){
            $user->update([
                'password'=>Hash::make($request->new_password)
            ]);
                return response()->json([
                    'message'=>'Password Successfully Updated',
                ],200);
       }else{
        return response()->json([
            'message'=>'Old password does not matched!!',
        ],400);
       }
    }
}