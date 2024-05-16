<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Infrastructure\Persistence\Doctrine\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

#[Route( name:'app_')]
class AuthController extends AbstractController
{
    public function __construct(
        private VerifyEmailHelperInterface $verifyEmailHelper,
        private EntityManagerInterface $entityManager
    )
    {
    }

    /**
     * @throws VerifyEmailExceptionInterface
     */
    #[Route('/verify/email', name: 'verify_email')]
    public function verifyUserEmail(Request $request, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($request->query->get('id'));

        if (null === $user) {
            throw new \Exception('User not found');
        }

        $uri = $request->getScheme() .  '://'. $request->getHost() . $request->getRequestUri();

        try {
            $this->verifyEmailHelper->validateEmailConfirmation($uri, (string) $user->getId(), $user->getEmail());
        } catch (VerifyEmailExceptionInterface $exception) {
            throw new \Exception($exception->getReason());
        }

        $user->setIsVerified(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_activated');
    }

    #[Route('/activated', name: 'activated')]
    public function registered(): Response
    {
        return $this->json(['message' => 'User was activated, you can now login from the app!'], 200);
    }
}