<?php

namespace App\CatalogContext\Infrastructure\Persistence\Doctrine\Repository;

use App\CatalogContext\Domain\Venue\Venue;
use App\CatalogContext\Domain\Venue\VenueId;
use App\CatalogContext\Domain\Venue\VenueRepository;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Entity\VenueEntity;
use App\CatalogContext\Infrastructure\Persistence\Doctrine\Mapper\VenueMapper;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineVenueRepository implements VenueRepository
{
    public function __construct(private EntityManagerInterface $entityManager, private VenueMapper $venueMapper)
    {
    }

    public function save(Venue $venue): void
    {
        $repository = $this->entityManager->getRepository(VenueEntity::class);

        $existingEntity = $repository->find((string) $venue->id());

        if ($existingEntity instanceof VenueEntity) {
            //TODO: implement update later.

            return;
        }

        $entity = $this->venueMapper->toEntity($venue);

        $this->entityManager->persist($entity);
    }

    public function findById(VenueId $id): ?Venue
    {
        $entity = $this->entityManager->getRepository(VenueEntity::class)->find((string) $id);

        if (!$entity instanceof VenueEntity) {
            return null;
        }

        return $this->venueMapper->toDomain($entity);
    }

    public function findBySlug(string $slug): ?Venue
    {
        $entity = $this->entityManager->getRepository(VenueEntity::class)->findOneBy(['slug' => $slug]);

        if (!$entity instanceof VenueEntity) {
            return null;
        }

        return $this->venueMapper->toDomain($entity);
    }
}
