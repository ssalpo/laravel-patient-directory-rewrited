<?php

namespace Tests\Helpers;

use App\Models\User;

class UserHelper
{
    public static function makeUser(): User
    {
        return User::factory()->create();
    }

    public static function defaultPassword(): string
    {
        return 'secret';
    }
}
