<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\UserDTO;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\Entity\User;

class AuthService implements AuthServiceInterface
{
    public function __construct()
    {
    }

    public function loginUser(): void
    {

    }

    public function registerUser(): void
    {

    }
}