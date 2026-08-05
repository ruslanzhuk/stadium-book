<?php

namespace App\IdentityContext\UI\Controller;

use App\IdentityContext\Application\GetCurrentUser\GetCurrentUserCommand;
use App\IdentityContext\Application\GetCurrentUser\GetCurrentUserHandler;
use App\IdentityContext\Application\LogoutUser\LogoutUserCommand;
use App\IdentityContext\Application\LogoutUser\LogoutUserHandler;
use App\IdentityContext\Application\RegisterUser\RegisterUserCommand;
use App\IdentityContext\Application\RegisterUser\RegisterUserHandler;
use App\IdentityContext\Domain\User\Exception\UserAlreadyExistsException;
use App\IdentityContext\Domain\User\Exception\UserNotFoundException;
use App\IdentityContext\Infrastructure\Security\SecurityUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class AuthController extends AbstractController
{
    public function __construct(
        private readonly RegisterUserHandler $registerUserHandler,
        private readonly GetCurrentUserHandler $getCurrentUserHandler,
        private readonly LogoutUserHandler $logoutUserHandler,
    ) {
    }

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return $this->json(["message" => "Invalid JSON body"],  400);
        }

        foreach (["email", "password", "firstName", "lastName"] as $field) {
            if (empty($data[$field]) || !is_string($data[$field])) {
                return $this->json(["message" => sprintf('Field "%s" is required', $field)],  400);
            }
        }

        $command = new RegisterUserCommand(
            email: $data['email'],
            password: $data['password'],
            firstName: $data['firstName'],
            lastName: $data['lastName']);

        try {
            $this->registerUserHandler->handle($command);
        } catch (UserAlreadyExistsException $e) {
            return $this->json(["message" => $e->getMessage()],  409);
        } catch (\InvalidArgumentException $e) {
            return $this->json(["message" => $e->getMessage()], 400);
        }


        return $this->json(["message" => "Registration successful"], 201);
    }

    #[Route('/me', name: 'api_me', methods: ['GET'])]
    public function getCurrentUser(): JsonResponse
    {
        $securityUser = $this->getUser();

        if (!$securityUser instanceof SecurityUser) {
            return $this->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $result = $this->getCurrentUserHandler->handle(
                new GetCurrentUserCommand(
                    $securityUser->id()
                )
            );
        }   catch (UserNotFoundException $e) {
            return $this->json(['message' => $e->getMessage()], 404);
        }


        return $this->json($result);
    }


    #[Route('/logout', name: 'api_logout', methods: ['POST'])]
    public function logout(): JsonResponse
    {
        $securityUser = $this->getUser();

        if (!$securityUser instanceof SecurityUser) {
            return $this->json(['message' => 'Unauthorized'], 401);
        }


        $this->logoutUserHandler(new LogoutUserCommand($securityUser->id()));


        return $this->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
