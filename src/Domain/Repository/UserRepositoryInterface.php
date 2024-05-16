<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Infrastructure\Persistence\Doctrine\Entity\User;

Interface UserRepositoryInterface
{

    public function save(User $user): User;


    public function update(User $user): void;

    public function findByUsername(string $username): ?User;
}