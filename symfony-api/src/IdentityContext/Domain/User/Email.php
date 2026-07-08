<?php

namespace App\IdentityContext\Domain\User;

final readonly class Email
{
    public function __construct(private string $value)
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email');
        }
    }

    public function value(): string
    {
        return strtolower($this->value);
    }
}
