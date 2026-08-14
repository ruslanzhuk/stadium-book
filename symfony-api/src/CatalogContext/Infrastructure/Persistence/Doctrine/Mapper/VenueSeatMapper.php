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

    public function toEntity(VenueSeat $venueSeat, VenueRowEntity $venueRowEntity, ?VenueSeatEntity $entity): VenueSeatEntity
    {
        $entity ??= new VenueSeatEntity();

        $entity->setId($venueSeat->id());
        $entity->setRow($venueRowEntity);
        $entity->setSeatLabel($venueSeat->seatLabel());
        $entity->setSeatType($venueSeat->seatType());
        $entity->setXPos($venueSeat->xPos());
        $entity->setYPos($venueSeat->yPos());
        $entity->setWidth($venueSeat->width());
        $entity->setHeight($venueSeat->height());
        $entity->setRotation($venueSeat->rotation());
        $entity->setIsActive($venueSeat->isActive());
        $entity->setCreatedAt($venueSeat->createdAt());
        $entity->setUpdatedAt($venueSeat->updatedAt());

        return $entity;
    }
}
