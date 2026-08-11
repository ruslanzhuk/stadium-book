<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper;
use App\CatalogContext\Domain\Venue\VenueRowId;
use App\CatalogContext\Domain\Venue\VenueSeat;
use App\CatalogContext\Domain\Venue\VenueSeatId;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity\VenueRowEntity;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity\VenueSeatEntity;
use Symfony\Component\Uid\Uuid;

final class VenueSeatMapper
{
    public function toDomain(VenueSeatEntity $entity): VenueSeat
    {
        return VenueSeat::reconstitute(
            id: new VenueSeatId(Uuid::fromString($entity->id())),
            rowId: new VenueRowId(Uuid::fromString($entity->row()->id())),
            seatLabel: $entity->seatLabel(),
            seatType: $entity->seatType(),
            xPos: $entity->xPos(),
            yPos: $entity->yPos(),
            width: $entity->width(),
            height: $entity->height(),
            rotation: $entity->rotation(),
            isActive: $entity->isActive(),
            createdAt: $entity->createdAt(),
            updatedAt: $entity->updatedAt(),
        );
    }

    public function toEntity(VenueSeat $venueSeat, VenueRowEntity $venueRowEntity): VenueSeatEntity
    {
        return new VenueSeatEntity(
            id: (string) $venueSeat->id(),
            row: $venueRowEntity,
            seatLabel: $venueSeat->seatLabel(),
            seatType: $venueSeat->seatType(),
            xPos: $venueSeat->xPos(),
            yPos: $venueSeat->yPos(),
            width: $venueSeat->width(),
            height: $venueSeat->height(),
            rotation: $venueSeat->rotation(),
            isActive: $venueSeat->isActive(),
            createdAt: $venueSeat->createdAt(),
            updatedAt: $venueSeat->updatedAt(),
        );
    }
}
