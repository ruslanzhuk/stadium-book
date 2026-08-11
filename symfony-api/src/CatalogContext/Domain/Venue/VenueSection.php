<?php

namespace App\CatalogContext\Domain\Venue;

use DateTimeImmutable;

class VenueSection
{
    private VenueSectionId $id;

    private VenueId $venueId;

    private string $name;

    private int $displayOrder = 0;

    private int $capacity;

    private DateTimeImmutable $createdAt;

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

    public static function reconstitute(
        VenueSectionId $id,
        VenueId $venueId,
        string $name,
        int $displayOrder,
        int $capacity,
        DateTimeImmutable $createdAt,
        ?DateTimeImmutable $updatedAt
    ) {
        $venueSection = new self(
            venueId: $venueId,
            name: $name,
            displayOrder: $displayOrder,
            capacity: $capacity,
        );

        $venueSection->id = $id;
        $venueSection->createdAt = $createdAt;
        $venueSection->updatedAt = $updatedAt;

        return $venueSection;
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
