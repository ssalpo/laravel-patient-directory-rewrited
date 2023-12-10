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

        $condition = ['nickname' => $user->nickname, 'password' => UserHelper::defaultPassword()];

        $response = $this->postJson('/api/auth/login', $condition);

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'status',
            'data' => [
                'user' => [
                    'id',
                    'name',
                    'nickname',
                    'email',
                ],
                'token',
            ],
        ]);
    }

    public function test_inactive_user_cannot_login(): void
    {
        $user = UserHelper::makeInactiveUser();

        $condition = ['nickname' => $user->nickname, 'password' => UserHelper::defaultPassword()];

        $response = $this->postJson('/api/auth/login', $condition);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('inactive');
    }

    public function test_user_cannot_login_without_incorrect_data(): void
    {
        $response = $this->postJson('/api/auth/login', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['nickname', 'password']);
    }

    public function test_user_cannot_auth_with_incorrect_nickname(): void
    {
        $response = $this->postJson('/api/auth/login', ['nickname' => 'ssalpomishevich', 'password' => 'somepassword']);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('nickname');
    }
}
