<?php

namespace App\IdentityContext\Domain\User;

use DateTimeImmutable;

class User
{
    private ?UserId $id;
    private ?Email $email;
    private ?PasswordHash $passwordHash;
    private string $firstName;
    private string $lastName;
    private ?DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $deletedAt;
    private ?DateTimeImmutable $emailVerifiedAt;


    public function __construct(
        Email $email,
        PasswordHash $passwordHash,
        string $firstName,
        string $lastName,
    )
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;

        $this->firstName = $firstName;
        $this->lastName = $lastName;

        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->deletedAt = null;
        $this->emailVerifiedAt = null;

        $this->id = null;
    }

    public function id(): ?UserId
    {
        return $this->id;
    }

    public function email(): ?Email
    {
        return $this->email;
    }

    public function passwordHash(): ?PasswordHash
    {
        return $this->passwordHash;
    }

    public function firstName(): ?string
    {
        return $this->firstName;
    }

    public function lastName(): ?string
    {
        return $this->lastName;
    }

    public function updateName(string $firstName, string $lastName): void
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;

        $this->updatedAt = new DateTimeImmutable();
    }

    public function verifyEmail(): void
    {
        $this->emailVerifiedAt = new DateTimeImmutable();
    }

    public function isEmailVerified(): bool
    {
        return $this->emailVerifiedAt !== null;
    }

    public function delete(): void
    {
        $this->deletedAt = new DateTimeImmutable();
    }

    public function isDeleted(): bool
    {
        return $this->deletedAt !== null;
    }
}
