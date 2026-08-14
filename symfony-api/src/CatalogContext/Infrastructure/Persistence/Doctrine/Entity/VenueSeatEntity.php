<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: 'venue_seats')]
class VenueSeatEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private string $id;

    #[ORM\ManyToOne(targetEntity: VenueRowEntity::class)]
    #[ORM\JoinColumn(name: 'row_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private VenueRowEntity $row;

    #[ORM\Column(type: 'string', length: 25, nullable: false)]
    private string $seatLabel;

    #[ORM\Column(type: 'string', length: 25)]
    private string $seatType = 'standard';

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $xPos = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $yPos = null;

    #[ORM\Column(type: 'float')]
    private float $width = 1.0;
    #[ORM\Column(type: 'float')]
    private float $height = 1.0;

    #[ORM\Column(type: 'float')]
    private float $rotation = 0.0;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = true;

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

    public function row(): VenueRowEntity
    {
        return $this->row;
    }

    public function seatLabel(): string
    {
        return $this->seatLabel;
    }

    public function seatType(): string
    {
        return $this->seatType;
    }

    public function xPos(): ?float
    {
        return $this->xPos;
    }

    public function yPos(): ?float
    {
        return $this->yPos;
    }

    public function width(): float
    {
        return $this->width;
    }

    public function height(): float
    {
        return $this->height;
    }

    public function rotation(): float
    {
        return $this->rotation;
    }

    public function isActive(): bool
    {
        return $this->isActive;
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

    public function setRow(VenueRowEntity $row): void
    {
        $this->row = $row;
    }

    public function setSeatLabel(string $seatLabel): void
    {
        $this->seatLabel = $seatLabel;
    }

    public function setSeatType(string $seatType): void
    {
        $this->seatType = $seatType;
    }

    public function setXPos(?float $xPos): void
    {
        $this->xPos = $xPos;
    }

    public function setYPos(?float $yPos): void
    {
        $this->yPos = $yPos;
    }

    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    public function setRotation(float $rotation): void
    {
        $this->rotation = $rotation;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
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
