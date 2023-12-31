<?php

namespace App\Virtual\Responses\Wrappers;

use OpenApi\Attributes as OAT;

#[OAT\Schema(title: 'Doctor Response Wrapper')]
class DoctorResponseWrapper
{
    #[
        OAT\Property(
            title: 'Data',
            items: new OAT\Items(ref: '#/components/schemas/DoctorResponse')
        )
    ]
    private array $data;
}
