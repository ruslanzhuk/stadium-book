<?php

namespace App\CatalogContext\Domain\Venue;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Embeddable]
final readonly class VenueId
{
    #[ORM\Column(type: "uuid", unique: true)]
    private Uuid $value;

    public function __construct(Uuid $value)
    {
        $this->value = $value;
    }

    public static function generate(): self
    {
        return new self(Uuid::v7());
    }

    public function value(): Uuid
    {
        return $this->value;
    }

    public function equals(VenueId $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value->toRfc4122();
    }
}
