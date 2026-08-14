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

    public function toEntity(VenueRow $venueRow, VenueSectionEntity $venueSectionEntity, ?VenueRowEntity $entity): VenueRowEntity
    {
        $entity ??= new VenueRowEntity();

        $entity->setId($venueRow->id());
        $entity->setSection($venueSectionEntity);
        $entity->setRowLabel($venueRow->rowLabel());
        $entity->setDisplayOrder($venueRow->displayOrder());
        $entity->setCapacity($venueRow->capacity());
        $entity->setCreatedAt($venueRow->createdAt());
        $entity->setUpdatedAt($venueRow->updatedAt());

        return $entity;
    }

}
