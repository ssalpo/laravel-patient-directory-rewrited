<?php

namespace App\Virtual\Requests;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    title: 'Medical Clinic Request',
    required: ['name']
)]
class MedicalClinicRequest
{
    #[OAT\Property(title: 'Имя', example: 'Мед. учреждение 1')]
    public string $name;
}
