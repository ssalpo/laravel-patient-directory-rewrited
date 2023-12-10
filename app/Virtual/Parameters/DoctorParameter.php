<?php

namespace App\Virtual\Parameters;

use OpenApi\Attributes as OAT;

#[OAT\Parameter(
    name: 'doctor',
    description: 'ID доктора',
    in: 'path',
    required: true,
    schema: new OAT\Schema(type: 'string'),
    example: 6
)]
class DoctorParameter
{
}
