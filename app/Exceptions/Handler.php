<?php

namespace App\Exceptions;

use App\Services\ApiResponseService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {
            $exception = match (true) {
                $e instanceof HttpResponseException => $e->getResponse(),
                $e instanceof AuthenticationException => $this->unauthenticated($request, $e),
                $e instanceof ValidationException => $this->convertValidationExceptionToResponse($e, $request),
                default => $this->prepareException($e),
            };

            $defaultStatus = is_numeric($e->getCode()) && $e->getCode() ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;

            $statusCode = method_exists($exception, 'getStatusCode')
                ? $exception->getStatusCode()
                : $defaultStatus;

            return ApiResponseService::sendError(
                config('app.debug') ? $e->getMessage() : $this->customStatusMessages($exception, $statusCode),
                $statusCode,
                $exception->original['errors'] ?? [],
                config('app.debug') ? [
                    'code' => $e->getCode(),
                    // 'trace' => $e->getTrace(),
                ] : []
            );
        }

        return parent::render($request, $e);
    }

    private function customStatusMessages($e, int $statusCode): string
    {
        return match ($statusCode) {
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            422 => 'Validation Error',
            500 => 'Whoops, looks like something went wrong',
            default => $e->getMessage()
        };
    }
}
