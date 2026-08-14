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

    public function __construct()
    {
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

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setSection(VenueSectionEntity $section): void
    {
        $this->section = $section;
    }

    public function setRowLabel(string $rowLabel): void
    {
        $this->rowLabel = $rowLabel;
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
