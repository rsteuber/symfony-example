<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Entity\Party;
use App\Domain\Repository\PartyRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class PartyRepository extends EntityRepository implements PartyRepositoryInterface
{
    public function save(Party $party): void
    {
        // TODO: Implement save() method.
    }

    public function findByName(string $name): ?Party
    {
        return $this->findOneBy(['name' => $name]);
    }
}