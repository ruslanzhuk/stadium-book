<?php

namespace App\CatalogContext\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
final class EventController extends AbstractController
{
    #[Route('/events', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            [
                'id' => 1,
                'name' => 'Champions League Final',
                'date' => '2026-08-01',
                'stadium' => 'National Stadium'
            ],
            [
                'id' => 2,
                'name' => 'Rock Concert',
                'date' => '2026-09-15',
                'stadium' => 'Arena'
            ]
        ]);
    }
}
