<?php

namespace App\IdentityContext\Application\GetCurrentUser;

final readonly class CurrentUserResponse
{
    public function __construct(
        public int $id,
        public string $email,
        public string $firstName,
        public string $lastName,
        public array $roles,
    ) {

    }
}
