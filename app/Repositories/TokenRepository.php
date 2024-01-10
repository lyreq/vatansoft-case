<?php

namespace App\Repositories;

use App\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TokenRepository
{
    public function createToken(User $user)
    {
        $tokenResult = $user->createToken('csrfToken');
        $token = $tokenResult->token;
        return [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
        ];
    }
}
