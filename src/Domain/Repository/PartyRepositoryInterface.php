<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Party;

interface PartyRepositoryInterface
{
    /**
     * @param Party $party
     * @return void
     */
    public function save(Party $party): void;

    /**
     * @param int $id
     * @return Party|null
     */

    public function findByName(string $name): ?Party;
}