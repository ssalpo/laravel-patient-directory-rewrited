<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public function __construct(
        #[Rule('required|email|min:4|max:255')]
        public string $email,
        #[Rule('required|min:4|max:255')]
        public string $password,
    ) {
    }
}
