<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity;

use App\CatalogContext\Domain\Venue\Venue;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: "venue_sections")]
class VenueSectionEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private string $id;

    #[ORM\ManyToOne(targetEntity: VenueEntity::class)]
    #[ORM\JoinColumn(name: "venue_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private VenueEntity $venue;

    #[ORM\Column(type: 'string', length: 100, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'integer')]
    private int $displayOrder = 0;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $capacity;

    #[ORM\Column]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function venue(): VenueEntity
    {
        return $this->venue;
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

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setVenue(VenueEntity $venue): void
    {
        $this->venue = $venue;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDisplayOrder(int $displayOrder): void
    {
        $this->displayOrder = $displayOrder;
    }

    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}

