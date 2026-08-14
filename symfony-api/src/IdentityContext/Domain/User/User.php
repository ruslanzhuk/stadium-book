<?php

namespace App\IdentityContext\Domain\User;

use DateTimeImmutable;

final class User
{
    private ?int $id;
    private Email $email;
    private PasswordHash $passwordHash;
    private string $firstName;
    private string $lastName;

    /** @var list<string> */
    private array $roles = ['ROLE_USER'];
    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt = null;
    private ?DateTimeImmutable $deletedAt = null;
    private ?DateTimeImmutable $emailVerifiedAt = null;


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

        $this->id = null;
    }

    public static function reconstitute(
        int $id,
        Email $email,
        PasswordHash $passwordHash,
        string $firstName,
        string $lastName,
        array $roles,
        DateTimeImmutable $createdAt,
        ?DateTimeImmutable $updatedAt,
        ?DateTimeImmutable $deletedAt,
        ?DateTimeImmutable $emailVerifiedAt
    ): self {
        $user = new User(
            $email,
            $passwordHash,
            $firstName,
            $lastName,
        );

        $user->id = $id;
        $user->roles = $roles;
        $user->createdAt = $createdAt;
        $user->updatedAt = $updatedAt;
        $user->deletedAt = $deletedAt;
        $user->emailVerifiedAt = $emailVerifiedAt;

        return $user;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function passwordHash(): PasswordHash
    {
        return $this->passwordHash;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function roles(): array
    {
        $roles = $this->roles;

        if (!in_array('ROLE_USER', $roles, true)) {
            $roles[] = 'ROLE_USER';
        }

        return array_values(array_unique($roles));
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function deletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function emailVerifiedAt(): ?DateTimeImmutable
    {
        return $this->emailVerifiedAt;
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->roles(), true);
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
        $this->touch();
    }

    public function isDeleted(): bool
    {
        return $this->deletedAt !== null;
    }

    public function touch(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}
