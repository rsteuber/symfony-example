<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Infrastructure\Persistence\Doctrine\Entity\Party;

interface PartyRepositoryInterface
{
    /**
     * @param Party $party
     * @return void
     */
    public function save(Party $party): void;

    /**
     * @param string $name
     * @return Party|null
     */
    public function findByName(string $name): ?Party;
}