<?php

namespace App\IdentityContext\Application\GetCurrentUser;

class GetCurrentUserCommand
{
    public function __construct(
        public readonly int $userId
    ) {
    }
}
