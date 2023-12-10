<?php

namespace Tests\Helpers;

use App\Models\User;
use Laravel\Sanctum\Sanctum;

class UserHelper
{
    public static function auth()
    {
        Sanctum::actingAs(self::makeUser(), ['*'], 'api');
    }

    public static function makeUser(): User
    {
        return User::factory()->create();
    }

    public static function makeInactiveUser(): User
    {
        return User::factory()->create([
            'is_active' => false,
        ]);
    }

    public static function defaultPassword(): string
    {
        return 'secret';
    }
}
