<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * register new user
     * @param array $request
     * @return JsonResponse
     */
    public function register(array $request): JsonResponse
    {
        $user = new User;

        foreach ($request as $key => $value) {
            if($key !== "password"){
                $user->$key = $value;
            }
        }

        $user->password = Hash::make($request["password"]);
        $user->save();

        return response()->json([
            "data" => $user
        ]);
    }

    /**
     * login an existing user
     * @param array $request
     * @return JsonResponse
     */
    public function login(array $request): JsonResponse
    {
        if(!auth()->attempt($request)){
            return response()->json([
                "errors" => [
                    "message" => "Invalid credentials"
                ]
            ]);
        }

        $token = auth()->user()->createToken('auth_token')->accessToken;

        return response()->json([
            "data" => [
                "token" => $token
            ]
        ]);
    }

    /**
     * logout current user
     * @return mixed
     */
    public function logout(): mixed
    {
        return auth()->user()->token()->revoke();
    }

    /**
     * get profile of connected user
     * @return JsonResponse
     */
    public function getProfile(): JsonResponse
    {
        return response()->json([
            "data" => auth()->user()
        ]);
    }
}
