<?php

namespace App\IdentityContext\Application\LogoutUser;

final readonly class LogoutUserCommand
{
    public function __construct(
        public int $userId
    ) {
    }
}
