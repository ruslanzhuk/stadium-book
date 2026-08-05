<?php

namespace App\IdentityContext\Application\RegisterUser;

use App\IdentityContext\Domain\User\Email;
use App\IdentityContext\Domain\User\Exception\UserAlreadyExistsException;
use App\IdentityContext\Domain\User\User;
use App\IdentityContext\Domain\User\PasswordHasher;
use App\IdentityContext\Domain\User\UserRepository;

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
        $firstName = trim($command->firstName);
        $lastName = trim($command->lastName);

        if ($this->userRepository->findByEmail($email) !== null) {
            throw new UserAlreadyExistsException($email);
        }

        if (strlen($command->password) < 8) {
            throw new \InvalidArgumentException('Password needs to be at least 8 characters long.');
        }

        if ($firstName === '' || $lastName === '') {
            throw new \InvalidArgumentException('First name and last name are required.');
        }

        $passwordHash = $this->passwordHasher->hash($command->password);

        $user = new User(
            email: $email,
            passwordHash: $passwordHash,
            firstName: $firstName,
            lastName: $lastName,
        );

        $this->userRepository->save($user);
    }
}
