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

    public function toEntity(Venue $venue, ?VenueEntity $entity): VenueEntity
    {
        $entity ??= new VenueEntity();

        $entity->setId($venue->id());
        $entity->setName($venue->name());
        $entity->setSlug($venue->slug());
        $entity->setCity($venue->city());
        $entity->setAddress($venue->address());
        $entity->setCountry($venue->country());
        $entity->setCapacity($venue->capacity());
        $entity->setDescription($venue->description());
        $entity->setImageUrl($venue->imageUrl());
        $entity->setIsActive($venue->isActive());
        $entity->setCreatedAt($venue->createdAt());
        $entity->setUpdatedAt($venue->updatedAt());

        return $entity;
    }
}
