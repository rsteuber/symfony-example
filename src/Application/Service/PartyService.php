<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\PartyDTO;
use App\Infrastructure\Persistence\Doctrine\Entity\Party;
use App\Infrastructure\Persistence\Doctrine\Repository\PartyRepository;
use Exception;

class PartyService implements PartyServiceInterface
{
    private PartyRepository $partyRepository;

    public function __construct(PartyRepository $partyRepository)
    {
        $this->partyRepository = $partyRepository;
    }

    /**
     * @param PartyDTO $partyDTO
     * @return Party
     * @throws Exception
     */
    public function createParty(PartyDTO $partyDTO): Party
    {
        $party = new Party();
        $party->setName($partyDTO->getName());

        try {
            $this->partyRepository->save($party);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return $party;
    }

    public function updateParty(Party $party): void
    {
        $this->partyRepository->save($party);
    }

    public function deleteParty(Party $party): void
    {
        $this->partyRepository->delete($party);
    }

    public function getAllParties(): array
    {
        return $this->partyRepository->findAll();
    }

    public function getPartyById(int $id): ?Party
    {
        return $this->partyRepository->findById($id);
    }
}