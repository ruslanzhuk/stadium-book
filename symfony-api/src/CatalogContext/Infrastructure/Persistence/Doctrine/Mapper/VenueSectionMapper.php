<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper;

use App\CatalogContext\Domain\Venue\VenueId;
use App\CatalogContext\Domain\Venue\VenueSection;
use App\CatalogContext\Domain\Venue\VenueSectionId;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity\VenueEntity;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity\VenueSectionEntity;
use Symfony\Component\Uid\Uuid;

final class VenueSectionMapper
{
    public function toDomain(VenueSectionEntity $entity): VenueSection
    {
        return VenueSection::reconstitute(
            id: new VenueSectionId(Uuid::fromString($entity->id())),
            venueId: new VenueId(Uuid::fromString($entity->venue()->id())),
            name: $entity->name(),
            displayOrder: $entity->displayOrder(),
            capacity: $entity->capacity(),
            createdAt: $entity->createdAt(),
            updatedAt: $entity->updatedAt(),
        );
    }

    public function toEntity(VenueSection $venueSection, VenueEntity $venueEntity, ?VenueSectionEntity $entity): VenueSectionEntity
    {
        $entity ??= new VenueSectionEntity();

        $entity->setId($venueSection->id());
        $entity->setVenue($venueEntity);
        $entity->setName($venueSection->name());
        $entity->setDisplayOrder($venueSection->displayOrder());
        $entity->setCapacity($venueSection->capacity());
        $entity->setCreatedAt($venueSection->createdAt());
        $entity->setUpdatedAt($venueSection->updatedAt());

        return $entity;
    }
}
