<?php

namespace App\Repositories;

use App\Interfaces\SendEmailVerificationRepositoryInterface;
use App\Jobs\Auth\SendEmailVerificationMessage;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SendEmailVerificationRepository implements SendEmailVerificationRepositoryInterface
{

    /**
     * @param $user_id
     * @param Request $request
     * @return bool|JsonResponse
     */
    public function verify($user_id, Request $request): JsonResponse|bool
    {
        if (!$request->hasValidSignature()) {
            return response()->json(["message" => "Invalid/Expired url provided."], 401);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return true;
    }

    /**
     * @return bool|JsonResponse
     */
    public function resend(): JsonResponse|bool
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json(["message" => "Email already verified."], 400);
        }

        SendEmailVerificationMessage::dispatch(auth()->user());

        return true;
    }
}
