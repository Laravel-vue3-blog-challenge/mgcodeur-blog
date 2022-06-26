<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{

    public function login(array $request)
    {
        if(!auth()->attempt($request)){
            return response()->json([
                "message" => "Invalid credentials"
            ]);
        }

        return auth()->user()->createToken('auth_token')->accessToken;
    }

    public function logout(){
        return auth()->user()->token()->revoke();
    }

    public function getProfile(){
        return auth()->user();
    }
}
