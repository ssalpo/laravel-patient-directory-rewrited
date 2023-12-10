<?php

namespace App\Http\Controllers\Traits;

use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait HasApiResponse
{
    public function sendSuccess(array $data, string $message = '', int $code = Response::HTTP_OK): JsonResponse
    {
        return ApiResponseService::sendSuccess($data, $message, $code);
    }

    public function sendError(string $message, int $code = 400, array $errors = []): JsonResponse
    {
        return ApiResponseService::sendError($message, $code, $errors);
    }
}
