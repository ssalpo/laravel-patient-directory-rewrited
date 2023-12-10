<?php

namespace App\Http\Controllers;

use App\Data\LoginData;
use App\Data\UserData;
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
    public function login(LoginData $data): JsonResponse
    {
        $user = User::where('email', $data->email)->first();

        if (! $user || ! Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Некорректные данные переданы.'],
            ]);
        }

        return $this->sendSuccess([
            'user' => UserData::from($user),
            'token' => $user->createToken('', ['*'], now()->addYear())->plainTextToken,
        ]);
    }
}
