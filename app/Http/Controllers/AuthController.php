<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'phoneNumber' => 'required|string|unique:users,phoneNumber',
            'password' => 'required|string|confirmed',
            'address' => 'required|string'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'phoneNumber' => $fields['phoneNumber'],
            'password' => bcrypt($fields['password'],),
            'address' => $fields['address']
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
            'phoneNumber' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('phoneNumber', $fields['phoneNumber'])->first();

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
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
