<?php

namespace App\Vitrual\Responses\User;

use OpenApi\Attributes as OAT;

#[OAT\Schema(title: 'User Response')]
class UserResource
{
    #[OAT\Property(title: 'ID', example: 556)]
    private int $id;

    #[OAT\Property(title: 'Имя', example: 'Санжар')]
    public string $name;

    #[OAT\Property(title: 'Email', example: 'ssalpo@ya.ru')]
    public string $email;
}