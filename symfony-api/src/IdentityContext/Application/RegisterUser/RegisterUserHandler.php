<?php

namespace App\IdentityContext\Application\RegisterUser;

use App\IdentityContext\Domain\User\Email;

final readonly class RegisterUserHandler
{
    public function __construct(
        private UserRepository $userRepository,
        private PasswordHasher $passwordHasher,
    ) {
    }

    public function handle(RegisterUserCommand $command): void
    {
        $email = new Email($command->email);

        if ($this->userRepository->findByEmail($email) !== null) {
            throw new \DomainException('User with this email already exists.');
        }

        $passwordHash = $this->passwordHasher->hash($command->password);

        $user = new User(
            email: $email,
            passwordHash: $passwordHash,
            firstName: $command->firstName,
            lastName: $command->lastName,
        );

        $this->userRepository->save($user);
    }
}
