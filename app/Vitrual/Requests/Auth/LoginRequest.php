<?php

namespace App\Vitrual\Requests\Auth;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    title: 'Login Request',
    required: ['email', 'password']
)]
class LoginRequest
{
    #[OAT\Property(title: 'Email', example: 'ssalpo@ya.ru')]
    public string $email;

    #[OAT\Property(title: 'Пароль', example: 'secret')]
    public string $password;
}
