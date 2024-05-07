<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\PartyDTO;
use App\Infrastructure\Persistence\Doctrine\Entity\Party;

interface PartyServiceInterface
{
public function createParty(PartyDTO $partyDTO): Party;

public function updateParty(Party $party): void;

public function deleteParty(Party $party): void;

public function getAllParties(): array;

public function getPartyById(int $id): ?Party;
}