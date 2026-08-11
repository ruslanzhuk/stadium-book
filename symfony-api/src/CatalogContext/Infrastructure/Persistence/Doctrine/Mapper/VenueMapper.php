<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper;

use App\CatalogContext\Domain\Venue\Venue;
use App\CatalogContext\Domain\Venue\VenueId;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity\VenueEntity;

use Symfony\Component\Uid\Uuid;

final class VenueMapper
{
    public function toDomain(VenueEntity $entity): Venue
    {
        return Venue::reconstitute(
            id: new VenueId(
                Uuid::fromString($entity->id())
            ),
            name: $entity->name(),
            slug: $entity->slug(),
            city: $entity->city(),
            address: $entity->address(),
            country: $entity->country(),
            capacity: $entity->capacity(),
            description: $entity->description(),
            imageUrl: $entity->imageUrl(),
            isActive: $entity->isActive(),
            createdAt: $entity->createdAt(),
            updatedAt: $entity->updatedAt(),
        );
    }

    public function toEntity(Venue $venue): VenueEntity
    {
        return new VenueEntity(
            id: (string) $venue->id(),
            name: $venue->name(),
            slug: $venue->slug(),
            city: $venue->city(),
            address: $venue->address(),
            country: $venue->country(),
            capacity: $venue->capacity(),
            description: $venue->description(),
            imageUrl: $venue->imageUrl(),
            isActive: $venue->isActive(),
            createdAt: $venue->createdAt(),
            updatedAt: $venue->updatedAt(),
        );
    }
}
