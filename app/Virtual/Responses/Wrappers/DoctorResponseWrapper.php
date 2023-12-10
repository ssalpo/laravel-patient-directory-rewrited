<?php

namespace App\Virtual\Responses\Wrappers;

use App\Virtual\Responses\DoctorResource;
use OpenApi\Attributes as OAT;

#[OAT\Schema(title: 'Doctor Response Wrapper')]
class DoctorResponseWrapper
{
    #[OAT\Property(
        title: 'data',
        description: 'Data wrapper'
    )]
    private DoctorResource $data;
}
