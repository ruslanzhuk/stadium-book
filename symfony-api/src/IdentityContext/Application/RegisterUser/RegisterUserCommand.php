<?php

namespace App\IdentityContext\Application\RegisterUser;

final readonly class RegisterUserCommand
{
    public function __construct(
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
    )
    {
    }
}
