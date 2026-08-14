<?php

namespace App\CatalogContext\Domain\Venue;

use DateTimeImmutable;
class Venue
{
    private VenueId $id;

    private string $name;

    private string $slug;

    private string $city;

    private string $address;

    private string $country;

    private int $capacity;

    private ?string $description = null;

    private ?string $imageUrl = null;

    private bool $isActive  = true;

    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct(
        string $name,
        string $slug,
        string $city,
        string $address,
        string $country,
        int $capacity,
        ?string $description = null,
        ?string $imageUrl = null,
    )
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->city = $city;
        $this->address = $address;
        $this->country = $country;
        $this->capacity = $capacity;
        $this->description = $description;
        $this->imageUrl = $imageUrl;

        $this->createdAt = new DateTimeImmutable();

        $this->id = VenueId::generate();
    }

    public static function reconstitute(
        VenueId $id,
        string $name,
        string $slug,
        string $city,
        string $address,
        string $country,
        int $capacity,
        ?string $description,
        ?string $imageUrl,
        bool $isActive,
        DateTimeImmutable $createdAt,
        ?DateTimeImmutable $updatedAt
    ) : self
    {
        $venue = new self(
            name: $name,
            slug: $slug,
            city: $city,
            address: $address,
            country: $country,
            capacity: $capacity,
            description: $description,
            imageUrl: $imageUrl,
        );

        $venue->id = $id;
        $venue->isActive = $isActive;
        $venue->createdAt = $createdAt;
        $venue->updatedAt = $updatedAt;

        return $venue;
    }

    public function id(): VenueId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function capacity(): int
    {
        return $this->capacity;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function imageUrl(): ?string
    {
        return $this->imageUrl;
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
        if ($this->isActive()) {
            return;
        }

        $this->isActive = true;
        $this->touch();
    }

    public function deactivate(): void
    {
        if (!$this->isActive()) {
            return;
        }

        $this->isActive = false;
        $this->touch();
    }

    public function rename(string $name): void
    {
        $this->name = $name;
        $this->touch();
    }

    public function touch(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}
