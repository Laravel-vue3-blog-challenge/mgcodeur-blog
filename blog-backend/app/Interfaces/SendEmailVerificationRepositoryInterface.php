<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface SendEmailVerificationRepositoryInterface
{
    public function verify($user_id, Request $request);

    public function resend();
}
