<?php

namespace App\Shared\Domain\Identifier;

use Symfony\Component\Uid\Uuid;

trait UuidIdentifierTrait
{
    public static function generate(): static
    {
        return new static(Uuid::v7());
    }

    public function value(): Uuid
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value->equals($other->value);
    }

    public function __toString(): string
    {
        return $this->value->toRfc4122();
    }
}
