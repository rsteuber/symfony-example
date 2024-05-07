<?php

declare(strict_types=1);

namespace App\Application\DTO;

class PartyDTO
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}