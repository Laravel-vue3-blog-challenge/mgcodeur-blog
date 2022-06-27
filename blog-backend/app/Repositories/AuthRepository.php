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
     * @return User
     */
    public function register(array $request): User
    {

        $user = new User;

        foreach ($request as $key => $value) {
            if($key !== "password"){
                $user->$key = $value;
            }
        }

        $user->password = Hash::make($request["password"]);
        $user->save();

        $user->sendEmailVerificationNotification();

        return $user;
    }

    /**
     * login an existing user
     * @param array $credentials
     * @return JsonResponse
     */
    public function login(array $credentials): JsonResponse
    {
        if(!auth()->attempt($credentials)){
            return response()->json([
                "message" => "Invalid credentials"
            ]);
        }

        return auth()->user()->createToken('auth_token')->accessToken;
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
     * @return Authenticatable|null
     */
    public function getProfile(): ?Authenticatable
    {
        return auth()->user();
    }
}
