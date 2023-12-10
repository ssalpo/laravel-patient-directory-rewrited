<?php

namespace App\Vitrual\Responses\Auth;

use App\Vitrual\Responses\User\UserResource;
use OpenApi\Attributes as OAT;

#[OAT\Schema(title: 'Auth Token Response')]
class AuthTokenResponse
{
    #[OAT\Property(title: 'Пользователь')]
    public UserResource $user;

    #[OAT\Property(title: 'token', example: '6|owW6fSmQi2S4HJEFWZlFBp45qdnabSIcUcCnTzgQ495ea8e2')]
    public string $token;
}
