<?php

namespace App\Virtual\Responses;

use OpenApi\Attributes as OAT;

#[OAT\Schema(title: 'Doctor Response')]
class DoctorResource
{
    #[OAT\Property(title: 'ID', example: 556)]
    private int $id;

    #[OAT\Property(title: 'Имя', example: 'Санжар')]
    public string $name;

    #[OAT\Property(title: 'Телефон', example: '79521621026')]
    public ?int $phone;
}
