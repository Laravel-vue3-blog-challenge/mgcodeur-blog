<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\SendEmailVerificationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    private SendEmailVerificationRepository $verifyEmailRepository;

    public function __construct(SendEmailVerificationRepository $verifyEmailRepository){
        $this->verifyEmailRepository = $verifyEmailRepository;
    }

    /**
     * set users email_verified_at to true
     * @param $user_id
     * @param Request $request
     * @return JsonResponse
     */
    public function verify($user_id, Request $request): JsonResponse
    {
        $this->verifyEmailRepository->verify($user_id, $request);
        return response()->json(["message" => "L'utilisateur a bien été vérifié!"]);
    }

    /**
     * resend the email verification if user doesn't receive the email
     * @return JsonResponse
     */
    public function resend(): JsonResponse
    {
        $this->verifyEmailRepository->resend();
        return response()->json(["message" => "Email verification link sent on your email id"]);
    }
}
