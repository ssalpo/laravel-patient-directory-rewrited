<?php

namespace App\Virtual\Responses\Common;

use OpenApi\Attributes as OAT;

#[OAT\Response(
    response: 'unauthenticated',
    description: 'Unauthenticated',
    content: new OAT\JsonContent(
        properties: [
            new OAT\Property(
                property: 'status',
                type: 'bool',
                example: false
            ),
            new OAT\Property(
                property: 'message',
                type: 'string',
                example: 'Unauthorized'
            ),
        ]
    ),
)]
class UnauthenticatedResponse
{
}
