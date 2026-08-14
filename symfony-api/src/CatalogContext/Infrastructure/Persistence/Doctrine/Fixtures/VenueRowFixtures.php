<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Fixtures;

use App\CatalogContext\Domain\Venue\VenueRow;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity\VenueSectionEntity;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper\VenueRowMapper;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper\VenueSectionMapper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class VenueRowFixtures extends Fixture implements DependentFixtureInterface
{
    public const ROW_A_REFERENCE = 'venue-row-a';
    public const ROW_B_REFERENCE = 'venue-row-b';
    public const ROW_C_REFERENCE = 'venue-row-c';

    public function __construct(
        private VenueSectionMapper $venueSectionMapper,
        private VenueRowMapper $venueRowMapper,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        /** @var VenueSectionEntity $sectionAEntity */
        $sectionAEntity = $this->getReference(
            VenueSectionFixtures::SECTION_A_REFERENCE,
            VenueSectionEntity::class,
        );

        $sectionA = $this->venueSectionMapper->toDomain($sectionAEntity);

        $rowA = new VenueRow(
            sectionId: $sectionA->id(),
            rowLabel: 'A',
            displayOrder: 1,
            capacity: 3,
        );

        $rowAEntity = $this->venueRowMapper->toEntity(
            venueRow: $rowA,
            venueSectionEntity: $sectionAEntity,
            entity: null,
        );

        $manager->persist($rowAEntity);

        $this->addReference(
            self::ROW_A_REFERENCE,
            $rowAEntity,
        );

        $rowB = new VenueRow(
            sectionId: $sectionA->id(),
            rowLabel: 'B',
            displayOrder: 2,
            capacity: 3,
        );

        $rowBEntity = $this->venueRowMapper->toEntity(
            venueRow: $rowB,
            venueSectionEntity: $sectionAEntity,
            entity: null,
        );

        $manager->persist($rowBEntity);

        $this->addReference(
            self::ROW_B_REFERENCE,
            $rowBEntity,
        );

        /** @var VenueSectionEntity $sectionBEntity */
        $sectionBEntity = $this->getReference(
            VenueSectionFixtures::SECTION_B_REFERENCE,
            VenueSectionEntity::class,
        );

        $sectionB = $this->venueSectionMapper->toDomain($sectionBEntity);

        $rowC = new VenueRow(
            sectionId: $sectionB->id(),
            rowLabel: 'C',
            displayOrder: 1,
            capacity: 3,
        );

        $rowCEntity = $this->venueRowMapper->toEntity(
            venueRow: $rowC,
            venueSectionEntity: $sectionBEntity,
            entity: null,
        );

        $manager->persist($rowCEntity);

        $this->addReference(
            self::ROW_C_REFERENCE,
            $rowCEntity,
        );

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            VenueSectionFixtures::class,
        ];
    }
}
