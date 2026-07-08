<?php

namespace App\IdentityContext\Infrastructure\Security;

use App\IdentityContext\Domain\User\PasswordHash;
use App\IdentityContext\Domain\User\PasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;

final readonly class SymfonyPasswordHasher implements PasswordHasher
{
    private NativePasswordHasher $hasher;

    public function __construct()
    {
        $this->hasher = new NativePasswordHasher();
    }

    public function hash(string $plainPassword): PasswordHash
    {
        return new PasswordHash(
            $this->hasher->hash($plainPassword)
        );
    }

    public function verify(
        PasswordHash $hash,
        string $plainPassword
    ): bool {
        return $this->hasher->verify(
            $hash->value(),
            $plainPassword
        );
    }
}
