<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use OpenApi\Attributes as OAT;

class AuthController extends Controller
{
    #[OAT\Post(
        path: '/auth/login',
        summary: 'Вход в личный кабинет',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(
                ref: '#/components/schemas/LoginRequest'
            )
        ),
        tags: ['Авторизация'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'OK',
                content: new OAT\JsonContent(ref: '#/components/schemas/AuthLoginResponseWrapper')
            ),
            new OAT\Response(response: 422, description: 'Ошибка валидации'),
        ]
    )]
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Некорректные данные переданы.'],
            ]);
        }

        if (! $user->is_active) {
            throw ValidationException::withMessages([
                'inactive' => ['Пользователь не активен.'],
            ]);
        }

        return $this->sendSuccess([
            'user' => UserResource::make($user),
            'token' => $user->createToken('', ['*'], now()->addYear())->plainTextToken,
        ]);
    }
}
