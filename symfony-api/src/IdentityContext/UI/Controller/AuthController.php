<?php

namespace App\IdentityContext\UI\Controller;

use App\IdentityContext\Application\RegisterUser\RegisterUserCommand;
use App\IdentityContext\Application\RegisterUser\RegisterUserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class AuthController extends AbstractController
{
    public function __construct(private readonly RegisterUserHandler $registerUserHandler)
    {
    }

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new RegisterUserCommand(
            email: $data['email'],
            password: $data['password'],
            firstName: $data['firstName'],
            lastName: $data['lastName']);

        $this->registerUserHandler->handle($command);

        return new JsonResponse(
            ["message" => "Registration successful"],
            201
        );
    }
}
