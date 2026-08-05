<?php

namespace App\IdentityContext\Domain\User;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
final class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;
    #[ORM\Embedded(class: Email::class)]
    private Email $email;
    #[ORM\Embedded(class: PasswordHash::class)]
    private PasswordHash $passwordHash;
    #[ORM\Column(length: 100)]
    private string $firstName;
    #[ORM\Column(length: 100)]
    private string $lastName;

    /** @var list<string> */
    #[ORM\Column(type: 'json')]
    private array $roles = ['ROLE_USER'];
    #[ORM\Column]
    private DateTimeImmutable $createdAt;
    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;
    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $deletedAt = null;
    #[ORM\Column(nullable: true)]
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
