<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

  class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
    
         $user = User::create([
           'name'=> $request->name,
           'email'=> $request->email,

         'password'=> Hash::make($request ->password),    
     ]);

     $token = $user->createToken('api-token')->plainTextToken;

       return response()->json([
        'message' => 'User registered successfully',
        'token' => $token,  
        'user ' => $user,
       ],201);
   }

   public function login (loginRequest $request)

  {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'message' => 'User logged in successfully',
        'token' => $token,
        'user' => $user,
    ]);

    }

   public function logout()
   {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logged out successfully',
        ]);
   }
}   