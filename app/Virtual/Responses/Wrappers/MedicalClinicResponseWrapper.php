<?php

namespace App\Virtual\Responses\Wrappers;

use OpenApi\Attributes as OAT;

#[OAT\Schema(title: 'Medical Clinic Response Wrapper')]
class MedicalClinicResponseWrapper
{
    #[
        OAT\Property(
            title: 'Data',
            items: new OAT\Items(ref: '#/components/schemas/MedicalClinicResponse')
        )
    ]
    private array $data;
}
