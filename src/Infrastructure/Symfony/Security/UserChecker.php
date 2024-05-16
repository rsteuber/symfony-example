<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Security;

use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{

    /**
     * @inheritDoc
     */
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof UserInterface) {
            return;
        }

        if ($user->isVerified() === false) {
            throw new \Exception('User is not verified');
        }
    }

    /**
     * @inheritDoc
     */
    public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof UserInterface) {
            return;
        }

//        if ($user->getIsVerified() === false) {
//            throw new \Exception('User is not verified');
//        }
    }
}