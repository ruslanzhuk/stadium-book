<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper;

use App\CatalogContext\Domain\Venue\VenueRow;
use App\CatalogContext\Domain\Venue\VenueRowId;
use App\CatalogContext\Domain\Venue\VenueSectionId;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity\VenueRowEntity;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity\VenueSectionEntity;
use Symfony\Component\Uid\Uuid;

final class VenueRowMapper
{
    public function toDomain(VenueRowEntity $entity): VenueRow
    {
        return VenueRow::reconstitute(
            id: new VenueRowId(Uuid::fromString($entity->id())),
            sectionId: new VenueSectionId(Uuid::fromString($entity->section()->id())),
            rowLabel: $entity->rowLabel(),
            displayOrder: $entity->displayOrder(),
            capacity: $entity->capacity(),
            createdAt: $entity->createdAt(),
            updatedAt: $entity->updatedAt(),
        );
    }

    public function toEntity(VenueRow $venueRow, VenueSectionEntity $venueSectionEntity): VenueRowEntity
    {
        return new VenueRowEntity(
            id: (string) $venueRow->id(),
            section: $venueSectionEntity,
            rowLabel: $venueRow->rowLabel(),
            displayOrder: $venueRow->displayOrder(),
            capacity: $venueRow->capacity(),
            createdAt: $venueRow->createdAt(),
            updatedAt: $venueRow->updatedAt(),
        );
    }

}
