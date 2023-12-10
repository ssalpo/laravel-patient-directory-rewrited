<?php

namespace App\Virtual\Responses\Wrappers;

use App\Virtual\Responses\Auth\AuthTokenResponse;
use OpenApi\Attributes as OAT;

#[OAT\Schema(title: 'Auth Login Response Wrapper')]
class AuthLoginResponseWrapper
{
    #[OAT\Property(title: 'Status')]
    private bool $status;

    #[OAT\Property(
        title: 'data',
        description: 'Data wrapper'
    )]
    private AuthTokenResponse $data;
}
