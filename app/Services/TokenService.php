<?php

namespace App\Services;

use App\Facades\Response;
use App\Repositories\TokenRepository;
use Illuminate\Support\Facades\Auth;


class TokenService
{
    public $tokenRepo;
    function __construct()
    {
        $this->tokenRepo = new TokenRepository();
    }

    public function getToken(array $data)
    {
        if ($this->validateUser($data['email'], $data['password'])) {
            return $this->tokenRepo->createToken(Auth::user());
        }
        return Response::error("Email adresiniz veya parolanızı hatalı girdiniz!", 404);
    }

    protected function validateUser($email, $password)
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }
}
