<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Fixtures;

use App\CatalogContext\Domain\Venue\Venue;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper\VenueMapper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class VenueFixtures extends Fixture
{
    public const VENUE_REFERENCE = 'venue-national-stadium';

    public function __construct(
        private VenueMapper $venueMapper,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $venue = new Venue(
            name: 'National Stadium',
            slug: 'national-stadium',
            city: 'Warsaw',
            address: 'Aleja Poniatowskiego 1',
            country: 'POL',
            capacity: 58000,
            description: 'National stadium in Warsaw.',
            imageUrl: 'https://example.com/national-stadium.jpg',
        );

        $entity = $this->venueMapper->toEntity($venue, null);

        $manager->persist($entity);

        $this->addReference(
            self::VENUE_REFERENCE,
            $entity,
        );

        $manager->flush();
    }
}
