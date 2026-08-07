<?php

namespace App\CatalogContext\Domain\Venue;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: "venue_rows")]
class VenueRow
{
    #[ORM\Id]
    #[ORM\Embedded(class: VenueRowId::class)]
    private VenueRowId $id;

    #[ORM\Embedded(class: VenueSectionId::class, columnPrefix: "section_")]
    private VenueSectionId $sectionId;

    #[ORM\Column(type: "string", length: 25, nullable: false)]
    private string $rowLabel;

    #[ORM\Column(type: 'integer')]
    private int $displayOrder = 0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $capacity;

    #[ORM\Column]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct(
        VenueSectionId $sectionId,
        string $rowLabel,
        int $displayOrder,
        int $capacity,
    )
    {
        $this->sectionId = $sectionId;
        $this->rowLabel = $rowLabel;
        $this->displayOrder = $displayOrder;
        $this->capacity = $capacity;

        $this->createdAt = new DateTimeImmutable();

        $this->id = VenueRowId::generate();
    }

    public function id(): VenueRowId
    {
        return $this->id;
    }

    public function sectionId(): VenueSectionId
    {
        return $this->sectionId;
    }

    public function rowLabel(): string
    {
        return $this->rowLabel;
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
