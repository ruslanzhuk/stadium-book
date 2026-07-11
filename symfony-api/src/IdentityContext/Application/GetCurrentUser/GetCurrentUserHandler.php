<?php

namespace App\IdentityContext\Application\GetCurrentUser;

use App\IdentityContext\Domain\User\UserRepository;

class GetCurrentUserHandler
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }


    public function __invoke(GetCurrentUserCommand $query): array
    {
        $user = $this->userRepository->findById(
            $query->userId
        );


        return [
            'id' => $user->id(),
            'email' => $user->email()->value(),
            'firstName' => $user->firstName(),
            'lastName' => $user->lastName(),
        ];
    }
}
