<?php

namespace App\Virtual\Responses\Common;

use OpenApi\Attributes as OAT;

#[OAT\Response(
    response: 'validation',
    description: 'Ошибка валидации',
    content: new OAT\JsonContent()
)]
class ValidationResponse
{
}
