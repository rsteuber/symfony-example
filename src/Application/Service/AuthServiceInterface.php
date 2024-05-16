<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\RegisterUserDTO;
use App\Infrastructure\Persistence\Doctrine\Entity\User;

interface AuthServiceInterface
{
    public function registerUser(RegisterUserDTO $registerUserDTO): User;
}