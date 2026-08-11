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

    public function __construct(
        string $id,
        VenueRowEntity $row,
        string $seatLabel,
        string $seatType,
        ?float $xPos,
        ?float $yPos,
        float $width,
        float $height,
        float $rotation,
        bool $isActive,
        DateTimeImmutable $createdAt,
        ?DateTimeImmutable $updatedAt
    )
    {
        $this->id = $id;
        $this->row = $row;
        $this->seatLabel = $seatLabel;
        $this->seatType = $seatType;
        $this->xPos = $xPos;
        $this->yPos = $yPos;
        $this->width = $width;
        $this->height = $height;
        $this->rotation = $rotation;
        $this->isActive = $isActive;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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
}
