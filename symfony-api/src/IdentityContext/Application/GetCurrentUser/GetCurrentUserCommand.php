<?php

namespace App\IdentityContext\Application\GetCurrentUser;

final readonly class GetCurrentUserCommand
{
    public function __construct(
        public int $userId
    ) {
    }
}
