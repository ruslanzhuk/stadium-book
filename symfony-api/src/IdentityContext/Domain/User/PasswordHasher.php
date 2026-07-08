<?php

namespace App\IdentityContext\Domain\User;

interface PasswordHasher
{
    public function hash(string $plainPassword): PasswordHash;

    public function verify(
        PasswordHash $hash,
        string $plainPassword
    ): bool;
}
