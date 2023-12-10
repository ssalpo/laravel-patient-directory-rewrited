<?php

namespace Tests\Helpers;

use App\Models\User;

class UserHelper
{
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
