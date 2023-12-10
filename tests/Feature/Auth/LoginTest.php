<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Helpers\UserHelper;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_successful_login(): void
    {
        $user = UserHelper::makeUser();

        $condition = ['email' => $user->email, 'password' => UserHelper::defaultPassword()];

        $response = $this->postJson('/api/auth/login', $condition);

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'status',
            'data' => [
                'user' => [
                    'id',
                    'name',
                    'email',
                ],
                'token',
            ],
        ]);
    }

    public function test_user_cannot_login_without_incorrect_data(): void
    {
        $response = $this->postJson('/api/auth/login', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['email', 'password']);
    }

    public function test_user_cannot_auth_with_incorrect_email(): void
    {
        $response = $this->postJson('/api/auth/login', ['email' => 'wrongEmail', 'password' => 'somepassword']);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('email');
    }
}
