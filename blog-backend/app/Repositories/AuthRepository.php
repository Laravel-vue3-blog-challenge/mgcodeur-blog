<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $request){
        
        $user = new User;

        foreach ($request as $key => $value) {
            if($key !== "password"){
                $user->$key = $request[$key];
            }
        }
        
        $user->password = Hash::make($request["password"]);
        $user->save();

        $user->sendEmailVerificationNotification();

        return $user;
    }

    public function login(array $credentials)
    {
        if(!auth()->attempt($credentials)){
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
