<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Fixtures;

use App\CatalogContext\Domain\Venue\VenueSection;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity\VenueEntity;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper\VenueMapper;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper\VenueSectionMapper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class VenueSectionFixtures extends Fixture implements DependentFixtureInterface
{
    public const SECTION_A_REFERENCE = 'venue-section-a';
    public const SECTION_B_REFERENCE = 'venue-section-b';

    public function __construct(
        private VenueSectionMapper $venueSectionMapper,
        private VenueMapper $venueMapper,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        /** @var VenueEntity $venueEntity */
        $venueEntity = $this->getReference(
            VenueFixtures::VENUE_REFERENCE,
            VenueEntity::class,
        );

        $venue = $this->venueMapper->toDomain($venueEntity);

        $sectionA = new VenueSection(
            venueId: $venue->id(),
            name: 'Section A',
            displayOrder: 1,
            capacity: 6,
        );

        $sectionAEntity = $this->venueSectionMapper->toEntity(
            venueSection: $sectionA,
            venueEntity: $venueEntity,
            entity: null,
        );

        $manager->persist($sectionAEntity);

        $this->addReference(
            self::SECTION_A_REFERENCE,
            $sectionAEntity,
        );

        $sectionB = new VenueSection(
            venueId: $venue->id(),
            name: 'Section B',
            displayOrder: 2,
            capacity: 3,
        );

        $sectionBEntity = $this->venueSectionMapper->toEntity(
            venueSection: $sectionB,
            venueEntity: $venueEntity,
            entity: null,
        );

        $manager->persist($sectionBEntity);

        $this->addReference(
            self::SECTION_B_REFERENCE,
            $sectionBEntity,
        );

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            VenueFixtures::class,
        ];
    }
}
