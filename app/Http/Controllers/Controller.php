<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasApiResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OAT;

#[
    OAT\Info(version: '1.0', title: 'Laravel Patient Directory Api Documentation'),
    OAT\Server(url: L5_SWAGGER_CONST_HOST, description: 'API Server'),
    OAT\SecurityScheme(securityScheme: 'bearerAuth', type: 'http', scheme: 'bearer'),
]
class Controller extends BaseController
{
    use AuthorizesRequests, HasApiResponse, ValidatesRequests;
}
