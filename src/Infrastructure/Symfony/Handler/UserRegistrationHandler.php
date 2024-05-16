<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Handler;

use App\Infrastructure\Symfony\Security\EmailVerifier;
use App\Domain\User\Exception\LoadUserException;
use App\Infrastructure\Persistence\Doctrine\Entity\User;
use App\Infrastructure\Persistence\Doctrine\Repository\UserRepository;

use App\Infrastructure\Symfony\Message\UserRegistrationMessage;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Address;


#[AsMessageHandler]
class UserRegistrationHandler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EmailVerifier $emailVerifier
    )
    {
    }

    public function __invoke(UserRegistrationMessage $message): void
    {
        /* @var User $user */
        $user = $this->userRepository->find($message->getUserId());

        if (null === $user) {
            throw new LoadUserException(sprintf('User with id %s not found in the db', $message->getUserId()));
        }

        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            (new TemplatedEmail())
                ->from(new Address('mailer@topfeest.local', 'Mail'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('email/confirmation_email.html.twig')
        );
    }
}