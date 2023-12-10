<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ApiResponseService
{
    public static function sendSuccess(array $data, ?string $message = null, int $code = HttpResponse::HTTP_OK): JsonResponse
    {
        return response()->json(self::makeResponse($data, $message), $code);
    }

    public static function sendError(?string $message, int $code = 400, array $errors = [], array $additional = []): JsonResponse
    {
        return response()->json(self::makeError($message, $errors, $additional), $code);
    }

    private static function makeResponse(array $data, ?string $message = null): array
    {
        $result = [
            'status' => true,
            'data' => $data,
        ];

        if ($message) {
            $result['message'] = $message;
        }

        return $result;
    }

    private static function makeError(?string $message, array $errors = [], array $additional = []): array
    {
        $result = [
            'status' => false,
            'message' => $message,
        ];

        if (! empty($errors)) {
            $result['errors'] = $errors;
        }

        return $result + $additional;
    }
}
