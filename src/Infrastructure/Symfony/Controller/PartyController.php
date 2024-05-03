<?php

namespace App\Infrastructure\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Application\Service\PartyService;

#[Route('/api', name: 'app_')]
class PartyController extends AbstractController
{
    private readonly PartyService $partyService;

    public function __construct(PartyService $partyService) {
        $this->partyService = $partyService;
    }

    #[Route('/parties', name: 'parties')]
    public function index(): Response
    {
        $parties = $this->partyService->getAllParties();

        if (!$parties) {
            throw $this->createNotFoundException(
                'No parties found!'
            );
        }

        return $this->json($parties, Response::HTTP_OK);
    }
}
