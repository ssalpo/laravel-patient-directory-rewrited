<?php

namespace App\Virtual\Responses\Common;

use OpenApi\Attributes as OAT;

#[OAT\Response(
    response: 'notFound',
    description: 'Not Found',
    content: new OAT\JsonContent()
)]
class NotFoundResponse
{
}
