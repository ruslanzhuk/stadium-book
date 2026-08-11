<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: "venue_rows")]
class VenueRowEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private string $id;

    #[ORM\ManyToOne(targetEntity: VenueSectionEntity::class)]
    #[ORM\JoinColumn(name: 'section_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private VenueSectionEntity $section;

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
        string $id,
        VenueSectionEntity $section,
        string $rowLabel,
        int $displayOrder,
        int $capacity,
        DateTimeImmutable $createdAt,
        ?DateTimeImmutable $updatedAt
    )
    {
        $this->id = $id;
        $this->section = $section;
        $this->rowLabel = $rowLabel;
        $this->displayOrder = $displayOrder;
        $this->capacity = $capacity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function section(): VenueSectionEntity
    {
        return $this->section;
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
}
