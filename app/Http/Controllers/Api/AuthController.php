<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = \App\Models\User::where('email', $request->email)->first();
    
        // Check if user exists
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provided email is incorrect.'],
            ]);
        }
    
        // Check if password is correct
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided password is incorrect.'],
            ]);
        }
    
        // Generate a token for the authenticated user
        $token = $user->createToken('api-token')->plainTextToken;
    
        return response()->json([
            'token' => $token
        ]);
    }
    
}
