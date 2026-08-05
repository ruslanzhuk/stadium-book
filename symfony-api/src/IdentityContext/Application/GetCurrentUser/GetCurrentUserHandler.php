<?php

namespace App\IdentityContext\Application\GetCurrentUser;

use App\IdentityContext\Domain\User\Exception\UserNotFoundException;
use App\IdentityContext\Domain\User\UserRepository;

final readonly class GetCurrentUserHandler
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }


    public function handle(GetCurrentUserCommand $query): CurrentUserResponse
    {
        $user = $this->userRepository->findById(
            $query->userId
        );

        if ($user === null) {
            throw new UserNotFoundException($query->userId);
        }


        return new CurrentUserResponse(
            id: $user->id(),
            email: $user->email()->value(),
            firstName:  $user->firstName(),
            lastName:  $user->lastName(),
            roles: $user->roles(),
        );
    }
}
