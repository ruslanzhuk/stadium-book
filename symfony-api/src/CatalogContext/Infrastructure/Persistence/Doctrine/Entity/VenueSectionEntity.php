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

    public function __construct(
        string $id,
        VenueEntity $venue,
        string $name,
        int $displayOrder,
        int $capacity,
        DateTimeImmutable $createdAt,
        ?DateTimeImmutable $updatedAt,
    ) {
        $this->id = $id;
        $this->venue = $venue;
        $this->name = $name;
        $this->displayOrder = $displayOrder;
        $this->capacity = $capacity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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
}

