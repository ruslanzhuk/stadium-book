<?php

namespace App\CatalogContext\Domain\Venue;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: "venues")]
class Venue
{
    #[ORM\Id]
    #[ORM\Embedded(class: VenueId::class)]
    private VenueId $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $slug;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $city;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $address;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $country;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $capacity;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column(type: 'bool', nullable: false)]
    private bool $isActive  = true;

    #[ORM\Column]
    private DateTimeImmutable $createdAt;
    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct(
        string $name,
        string $slug,
        string $city,
        string $address,
        string $country,
        int $capacity,
        string $description,
        string $imageUrl,
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

    public function id(): ?VenueId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
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
        if ($this->isActive()) {
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
