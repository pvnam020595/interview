<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    //
    public function login(AuthRequest $authRequest) {
        if ($authRequest->validated()) {
           $credentials = request(['name', 'password']);
           $token = auth()->attempt($credentials);
           if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 402);
           }
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    public function logout() {
        auth()->logout();
        return response()->json([
            'data' => [],
            'message' => 'Success'
        ], 200);
    }
}
