<?php

namespace App\Virtual\Responses;

use OpenApi\Attributes as OAT;

#[OAT\Schema(title: 'Medical Clinic Response')]
class MedicalClinicResponse
{
    #[OAT\Property(title: 'ID', example: 556)]
    private int $id;

    #[OAT\Property(title: 'Имя', example: 'Мед. учреждение 1')]
    public string $name;
}
