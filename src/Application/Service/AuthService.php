<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\RegisterUserDTO;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\Entity\User;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserPasswordHasherInterface $userPasswordHasher
    )
    {

    }

    /**
     * @param RegisterUserDTO $registerUserDTO
     * @return User
     * @throws Exception
     */
    public function registerUser(RegisterUserDTO $registerUserDTO): User
    {
        $user = new User();
        $user->setUsername($registerUserDTO->getUsername());
        $user->setEmail($registerUserDTO->getEmail());
        $user->setPassword(
            $this->userPasswordHasher->hashPassword($user, $registerUserDTO->getPassword())
        );

        try {
            $this->userRepository->save($user);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $user;
    }
}