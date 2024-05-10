<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Application\DTO\RegisterUserDTO;
use App\Application\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'app_')]
class AuthController extends AbstractController
{
    public function __construct(
        private readonly AuthService $authService)
    {
    }

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function registerUser(Request $request): Response
    {
        $userData = json_decode($request->getContent(), true);
        $registerUserDTO = new RegisterUserDTO($userData['username'], $userData['email'], $userData['password']);

        try {
            $this->authService->registerUser($registerUserDTO);
        } catch (\Exception $exception) {
            return $this->json(['message' => $exception->getMessage()], 400);
        }

        return $this->json(['message' => 'User was registered, please activate via link in your email!'], 200);
    }
}