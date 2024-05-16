<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Message;

class UserRegistrationMessage
{

    public function __construct(
        private readonly int $userId
    )
    {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}