<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\RegisterUserDTO;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\Entity\User;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository)
    {

    }

    public function registerUser(RegisterUserDTO $registerUserDTO): void
    {
        $user = new User();
        $user->setUsername($registerUserDTO->getUsername());
        $user->setEmail($registerUserDTO->getEmail());
        $user->setPassword($registerUserDTO->getPassword());

        $this->userRepository->save($user);
    }
}