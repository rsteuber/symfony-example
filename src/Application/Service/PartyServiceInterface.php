<?php

namespace App\Application\Service;

use App\Domain\Entity\Party;

interface PartyServiceInterface
{
public function createParty(array $partyData): Party;

public function updateParty(Party $party, string $name, \DateTime $date): Party;

public function deleteParty(Party $party): void;

public function getAllParties(): array;

public function getPartyById(int $id): ?Party;
}