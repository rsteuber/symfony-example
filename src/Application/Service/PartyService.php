<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\PartyDTO;
use App\Infrastructure\Persistence\Doctrine\Entity\Party;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Exception;

class PartyService implements PartyServiceInterface
{
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Party::class);
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