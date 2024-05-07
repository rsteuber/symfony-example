<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\PartyDTO;
use App\Domain\Repository\PartyRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\Entity\Party;
use Exception;

class PartyService implements PartyServiceInterface
{
    private PartyRepositoryInterface $repository;

    public function __construct(PartyRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
            $this->repository->save($party);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return $party;
    }

    public function updateParty(Party $party): void
    {
        $this->repository->save($party);
    }

    public function deleteParty(Party $party): void
    {
        $this->repository->delete($party);
    }

    public function getAllParties(): array
    {
        return $this->repository->findAll();
    }

    public function getPartyById(int $id): ?Party
    {
        return $this->partyRepository->findById($id);
    }
}