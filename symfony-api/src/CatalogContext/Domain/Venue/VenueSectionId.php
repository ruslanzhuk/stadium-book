<?php

namespace App\CatalogContext\Domain\Venue;

use App\Shared\Domain\Identifier\UuidIdentifierTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

final readonly class VenueSectionId
{
    use UuidIdentifierTrait;

    private Uuid $value;

    public function __construct(Uuid $value)
    {
        $this->value = $value;
    }
}
