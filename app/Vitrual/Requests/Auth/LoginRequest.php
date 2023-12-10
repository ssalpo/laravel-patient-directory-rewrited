<?php

namespace App\Vitrual\Requests\Auth;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    title: 'Login Request',
    required: ['nickname', 'password']
)]
class LoginRequest
{
    #[OAT\Property(title: 'Ник', example: 'ssalpo')]
    public string $nickname;

    #[OAT\Property(title: 'Пароль', example: 'secret')]
    public string $password;
}
