<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Application\DTO\PartyDTO;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/parties', name: 'parties', methods: ['GET'])]
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

    /**
     * @throws Exception
     */
    #[Route('/parties', name: 'parties_post', methods: ['POST'])]
    public function createParty(Request $request): Response
    {
        $partyData = json_decode($request->getContent(), true);
        $partyDTO = new PartyDTO();
        $partyDTO->setName($partyData['name']);

        $party = $this->partyService->createParty($partyDTO);

        $responseData = [
            'id' => $party->getId(),
            'name' => $party->getName(),
        ];

        return $this->json($responseData, Response::HTTP_CREATED, ['Content-Type' => 'application/json']);
    }
}
