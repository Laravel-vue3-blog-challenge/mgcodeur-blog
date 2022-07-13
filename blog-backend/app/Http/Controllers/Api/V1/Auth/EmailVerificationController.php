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
        return $this->verifyEmailRepository->verify($user_id, $request);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/auth/email/resend",
     *      operationId="resend",
     *      tags={"Auth"},
     *      security={
     *          {"passport": {}},
     *      },
     *      summary="Resend",
     *      description="Resend email verification of current user",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *  )
     */
    public function resend(): JsonResponse
    {
        return $this->verifyEmailRepository->resend();
    }
}
