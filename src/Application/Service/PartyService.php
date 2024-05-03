<?php

namespace App\Application\Service;

use App\Domain\Entity\Party;
use App\Infrastructure\Persistence\Doctrine\Repository\PartyRepository;

class PartyService implements PartyServiceInterface
{
    private PartyRepository $partyRepository;

    public function __construct(PartyRepository $partyRepository)
    {
        $this->partyRepository = $partyRepository;
    }

    /**
     * @param array $partyData
     * @return Party
     * @throws \Exception
     */
    public function createParty(array $partyData): Party
    {
        $party = new Party();
        $party->setName($partyData['name']);

        try {
            $this->partyRepository->save($party);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $party;
    }

    public function updateParty(Party $party, string $name, \DateTime $date): Party
    {
        // TODO: Implement updateParty() method.
    }

    public function deleteParty(Party $party): void
    {
        // TODO: Implement deleteParty() method.
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