<?php

namespace App\IdentityContext\Domain\User;

final readonly class UserId
{
    public function __construct(private int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('UserId value must be positive');
        }
    }

    public function value(): int
    {
        return $this->value;
    }

}
