<?php

namespace App\IdentityContext\Infrastructure\Security;

use App\IdentityContext\Domain\User\PasswordHash;
use App\IdentityContext\Domain\User\PasswordHasher;
use Symfony\Component\PasswordHasher\PasswordHasherInterface as SymfonyPasswordHasherInterface;

final readonly class SymfonyPasswordHasher implements PasswordHasher
{
    public function __construct(
        private SymfonyPasswordHasherInterface $hasher,
    )
    {
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
