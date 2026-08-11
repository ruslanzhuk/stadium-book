<?php

namespace App\CatalogContext\Domain\Venue;

use DateTimeImmutable;

class VenueRow
{
    private VenueRowId $id;

    private VenueSectionId $sectionId;

    private string $rowLabel;

    private int $displayOrder = 0;

    private int $capacity;

    private DateTimeImmutable $createdAt;


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

    public static function reconstitute(
        VenueRowId $id,
        VenueSectionId $sectionId,
        string $rowLabel,
        int $displayOrder,
        int $capacity,
        DateTimeImmutable $createdAt,
        ?DateTimeImmutable $updatedAt
    ) {
        $venueRow = new self(
            sectionId: $sectionId,
            rowLabel: $rowLabel,
            displayOrder: $displayOrder,
            capacity: $capacity,
        );

        $venueRow->id = $id;

        $venueRow->createdAt = $createdAt;
        $venueRow->updatedAt = $updatedAt;

        return $venueRow;
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

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function touch(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}
