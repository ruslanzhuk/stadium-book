<?php

namespace App\IdentityContext\Infrastructure\Security;

use App\IdentityContext\Domain\User\Email;
use App\IdentityContext\Domain\User\UserRepository;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final readonly class UserProvider implements UserProviderInterface
{
    public function __construct(
        private UserRepository $userRepository,
    )
    {
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findByEmail(
            new Email($identifier)
        );

        if (null === $user) {
            throw new UserNotFoundException();
        }

        return new SecurityUser(
            id: $user->id(),
            email: $user->email(),
            passwordHash: $user->passwordHash()->value(),
        );
    }


    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return $class === SecurityUser::class;
    }
}
