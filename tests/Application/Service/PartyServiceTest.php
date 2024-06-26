<?php

namespace App\Tests\Application\Service;

use App\Application\DTO\PartyDTO;
use App\Application\Service\PartyService;
use App\Infrastructure\Persistence\Doctrine\Entity\Party;
use App\Infrastructure\Persistence\Doctrine\Repository\PartyRepository;
use PHPUnit\Framework\TestCase;

class PartyServiceTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testCreateParty(): void
    {
        // Create a mock PartyRepository
        $mockRepository = $this->createMock(PartyRepository::class);
        $partyDTO = new PartyDTO();
        $partyDTO->setName('Test Party');

        // Set up expectation for save method
        $mockRepository->expects($this->once())
            ->method('save')
            ->with($this->callback(function (Party $party) use ($partyDTO) {
                $this->assertEquals($partyDTO->getName(), $party->getName());
                return true; // Return true to satisfy the expectation
            }));

        // Instantiate PartyService with the mock repository
        $partyService = new PartyService($mockRepository);

        // Call the method being tested
        $party = $partyService->createParty($partyDTO);

        // Assert that the returned party object is of type Party
        $this->assertInstanceOf(Party::class, $party);
    }

    public function testGetAllParties(): void
    {
        // Create a mock PartyRepository
        $mockRepository = $this->createMock(PartyRepository::class);

        // Set up expectation for findAll method
        $mockRepository->expects($this->once())
            ->method('findAll')
            ->willReturn([]);

        // Instantiate PartyService with the mock repository
        $partyService = new PartyService($mockRepository);

        // Call the method being tested
        $parties = $partyService->getAllParties();

        // Assert that the returned value is an array
        $this->assertIsArray($parties);
        // Optionally, you can assert other conditions on the returned parties array
        // For example, assert count, specific content, etc.
    }
}
