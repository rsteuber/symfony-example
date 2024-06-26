<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Infrastructure\Persistence\Doctrine\Entity\Party;
use App\Domain\Repository\PartyRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class PartyRepository extends ServiceEntityRepository implements PartyRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        private EntityManagerInterface $entityManager
    )
    {
        parent::__construct($registry, Party::class);
    }

    public function save(Party $party): void
    {
        $this->entityManager->persist($party);
        $this->entityManager->flush();
    }

    public function findByName(string $name): ?Party
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findById(int $id)
    {
        return $this->find($id);
    }

    public function delete(Party $party)
    {
        $this->delete($party);
    }
}