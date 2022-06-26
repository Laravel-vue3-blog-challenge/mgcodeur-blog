<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;

class ProfileController extends Controller
{
    private AuthRepository $authRepository;

    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository){
        $this->authRepository = $authRepository;
    }
    /**
     * @OA\Get(
     *      path="/api/v1/auth/profile",
     *      operationId="profile",
     *      tags={"Auth"},
     *      security={
     *          {"passport": {}},
     *      },
     *      summary="user info",
     *      description="Informations of connected user",
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
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function profile(){
        return response()->json($this->authRepository->getProfile());
    }
}
