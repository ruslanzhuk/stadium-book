<?php

namespace App\CatalogContext\Domain\Venue;

interface VenueRepository
{

    public function save(Venue $venue): void;

    public function findById(VenueId $id): ?Venue;

    public function findBySlug(string $slug): ?Venue;

}
