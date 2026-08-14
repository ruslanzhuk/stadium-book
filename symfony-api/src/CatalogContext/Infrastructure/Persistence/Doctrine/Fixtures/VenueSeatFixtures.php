<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Fixtures;

use App\CatalogContext\Domain\Venue\VenueSeat;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity\VenueRowEntity;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper\VenueRowMapper;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper\VenueSeatMapper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class VenueSeatFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private VenueRowMapper $venueRowMapper,
        private VenueSeatMapper $venueSeatMapper,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        /** @var VenueRowEntity $rowAEntity */
        $rowAEntity = $this->getReference(
            VenueRowFixtures::ROW_A_REFERENCE,
            VenueRowEntity::class,
        );

        $rowA = $this->venueRowMapper->toDomain($rowAEntity);

        foreach (['A1', 'A2', 'A3'] as $index => $label) {
            $seat = new VenueSeat(
                rowId: $rowA->id(),
                seatLabel: $label,
                xPos: (float) $index,
                yPos: 0.0,
            );

            $seatEntity = $this->venueSeatMapper->toEntity(
                venueSeat: $seat,
                venueRowEntity: $rowAEntity,
                entity: null,
            );

            $manager->persist($seatEntity);
        }

        /** @var VenueRowEntity $rowBEntity */
        $rowBEntity = $this->getReference(
            VenueRowFixtures::ROW_B_REFERENCE,
            VenueRowEntity::class,
        );

        $rowB = $this->venueRowMapper->toDomain($rowBEntity);

        foreach (['B1', 'B2', 'B3'] as $index => $label) {
            $seat = new VenueSeat(
                rowId: $rowB->id(),
                seatLabel: $label,
                xPos: (float) $index,
                yPos: 1.0,
            );

            $seatEntity = $this->venueSeatMapper->toEntity(
                venueSeat: $seat,
                venueRowEntity: $rowBEntity,
                entity: null,
            );

            $manager->persist($seatEntity);
        }

        /** @var VenueRowEntity $rowCEntity */
        $rowCEntity = $this->getReference(
            VenueRowFixtures::ROW_C_REFERENCE,
            VenueRowEntity::class,
        );

        $rowC = $this->venueRowMapper->toDomain($rowCEntity);

        foreach (['C1', 'C2', 'C3'] as $index => $label) {
            $seat = new VenueSeat(
                rowId: $rowC->id(),
                seatLabel: $label,
                xPos: (float) $index,
                yPos: 2.0,
            );

            $seatEntity = $this->venueSeatMapper->toEntity(
                venueSeat: $seat,
                venueRowEntity: $rowCEntity,
                entity: null,
            );

            $manager->persist($seatEntity);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            VenueRowFixtures::class,
        ];
    }
}
