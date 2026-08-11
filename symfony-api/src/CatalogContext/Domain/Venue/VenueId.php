<?php

namespace App\CatalogContext\Domain\Venue;

use App\Shared\Domain\Identifier\UuidIdentifierTrait;
use Symfony\Component\Uid\Uuid;

final readonly class VenueId
{
    use UuidIdentifierTrait;
    private Uuid $value;

    public function __construct(Uuid $value)
    {
        $this->value = $value;
    }
}
