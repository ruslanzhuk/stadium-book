<?php

namespace App\IdentityContext\Domain\User;

final readonly class PasswordHash
{
    public function __construct(private string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}
