<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function register(array $request);
    
    public function login(array $request);

    public function logout();

    public function getProfile();
}
