<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required"
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        if(!auth()->attempt($request->only(["email", "password"]))){
            return response()->json([
                "message" => "Invalid Crédentials"
            ]);
        }

        $token = auth()->user()->createToken('auth_token')->accessToken;

        return response()->json([
            "message" => "Logged In successfully",
            "token" => $token
        ]);
    }

    public function logout(){

    }
}
