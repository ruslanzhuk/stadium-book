<?php

namespace App\CatalogContext\Domain\Venue;

use App\Shared\Domain\Identifier\UuidIdentifierTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Embeddable]
final readonly class VenueRowId
{
    use UuidIdentifierTrait;

    #[ORM\Column(name: 'id', type: 'uuid')]
    private Uuid $value;

    public function __construct(Uuid $value)
    {
        $this->value = $value;
    }
}
