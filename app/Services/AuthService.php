<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public $tokenService;

    function __construct()
    {
        $this->tokenService = new TokenService();
    }
    public function login(array $data)
    {
        return $this->tokenService->getToken($data);
    }

    public function register(array $data)
    {
        $user = User::create($data);
        return $this->tokenService->getToken($data);

    }
}
