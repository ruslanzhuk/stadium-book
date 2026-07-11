<?php

namespace App\IdentityContext\Application\LogoutUser;

final readonly class LogoutUserHandler
{
    public function __invoke(
        LogoutUserCommand $command
    ): void {
        // later:
        // revoke refresh token
        // invalidate sessions
    }
}
