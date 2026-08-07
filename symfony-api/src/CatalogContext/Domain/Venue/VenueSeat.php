<?php

namespace App\CatalogContext\Domain\Venue;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: 'venue_seats')]
class VenueSeat
{
    #[ORM\Id]
    #[ORM\Embedded(class: VenueSeatId::class)]
    private VenueSeatId $id;

    #[ORM\Embedded(class: VenueRowId::class, columnPrefix: "row_")]
    private VenueRowId $rowId;

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
    private float $rotation = 0;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive = true;

    #[ORM\Column]
    private DateTimeImmutable $createdAt;
    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct(
        VenueRowId $rowId,
        string $seatLabel,
        string $seatType,
        float $xPos,
        float $yPos,
        float $width,
        float $height,
        float $rotation,
    )
    {
        $this->rowId = $rowId;
        $this->seatLabel = $seatLabel;
        $this->seatType = $seatType;
        $this->xPos = $xPos;
        $this->yPos = $yPos;
        $this->width = $width;
        $this->height = $height;
        $this->rotation = $rotation;

        $this->createdAt = new DateTimeImmutable();

        $this->id = VenueSeatId::generate();
    }

    public function id(): VenueSeatId
    {
        return $this->id;
    }

    public function rowId(): VenueRowId
    {
        return $this->rowId;
    }

    public function seatLabel(): string
    {
        return $this->seatLabel;
    }

    public function fullLabel(): string
    {
        return $this->fullLabel;
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

    public function width(): ?float
    {
        return $this->width;
    }

    public function height(): ?float
    {
        return $this->height;
    }

    public function rotation(): ?float
    {
        return $this->rotation;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function activate(): void
    {
        $this->isActive = true;
        $this->touch();
    }

    public function deactivate(): void
    {
        $this->isActive = false;
        $this->touch();
    }

    public function touch(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}
