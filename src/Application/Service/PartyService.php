<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\PartyDTO;
use App\Domain\Repository\PartyRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\Entity\Party;
use Exception;

readonly class PartyService implements PartyServiceInterface
{
    public function __construct(
        private PartyRepositoryInterface $repository)
    {
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

    public function updateParty(PartyDTO $party): void
    {
        $this->repository->save($party);
    }

    public function deleteParty(PartyDTO $party): void
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