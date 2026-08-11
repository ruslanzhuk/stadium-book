<?php

namespace App\CatalogContext\Domain\Venue;

use DateTimeImmutable;

class VenueSeat
{
    private VenueSeatId $id;

    private VenueRowId $rowId;

    private string $seatLabel;

    private string $seatType = 'standard';

    private ?float $xPos = null;

    private ?float $yPos = null;

    private float $width = 1.0;
    private float $height = 1.0;

    private float $rotation = 0.0;

    private bool $isActive = true;

    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct(
        VenueRowId $rowId,
        string $seatLabel,
        float $width = 1.0,
        float $height = 1.0,
        float $rotation = 0.0,
        string $seatType = 'standard',
        ?float $xPos = null,
        ?float $yPos = null,
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

    public static function reconstitute(
        VenueSeatId $id,
        VenueRowId $rowId,
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
    ) {
        $venueSeat = new VenueSeat(
            rowId: $rowId,
            seatLabel: $seatLabel,
            width: $width,
            height: $height,
            rotation: $rotation,
            seatType: $seatType,
            xPos: $xPos,
            yPos: $yPos,
        );

        $venueSeat->id = $id;
        $venueSeat->isActive = $isActive;
        $venueSeat->createdAt = $createdAt;
        $venueSeat->updatedAt = $updatedAt;

        return $venueSeat;
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
