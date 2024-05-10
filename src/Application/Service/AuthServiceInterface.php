<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\RegisterUserDTO;

interface AuthServiceInterface
{
    public function registerUser(RegisterUserDTO $registerUserDTO): void;
}