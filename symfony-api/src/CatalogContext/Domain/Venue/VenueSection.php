<?php

namespace App\CatalogContext\Domain\Venue;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: "venue_sections")]
class VenueSection
{
    #[ORM\Id]
    #[ORM\Embedded(class: VenueSectionId::class)]
    private VenueSectionId $id;

    #[ORM\Embedded(class: VenueId::class, columnPrefix: "venue_")]
    private VenueId $venueId;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'integer')]
    private int $displayOrder = 0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $capacity;

    #[ORM\Column]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct(
        VenueId $venueId,
        string $name,
        int $displayOrder,
        int $capacity,
    )
    {
        $this->venueId = $venueId;
        $this->name = $name;
        $this->displayOrder = $displayOrder;
        $this->capacity = $capacity;

        $this->createdAt = new DateTimeImmutable();

        $this->id = VenueSectionId::generate();
    }

    public function id(): VenueSectionId
    {
        return $this->id;
    }

    public function venueId(): VenueId
    {
        return $this->venueId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function displayOrder(): int
    {
        return $this->displayOrder;
    }

    public function capacity(): int
    {
        return $this->capacity;
    }

    public function touch(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}
