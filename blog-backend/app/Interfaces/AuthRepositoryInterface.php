<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function login(array $request);

    public function logout();

    public function getProfile();
}
