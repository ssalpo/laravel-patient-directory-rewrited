<?php

namespace App\Virtual\Requests;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    title: 'Doctor Request',
    required: ['name']
)]
class DoctorRequest
{
    #[OAT\Property(title: 'Имя', example: 'Николай Васильевич')]
    public string $name;

    #[OAT\Property(title: 'Телефон', default: null, example: '79521620126')]
    public ?int $phone;
}
