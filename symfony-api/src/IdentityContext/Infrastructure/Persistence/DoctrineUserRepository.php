<?php

namespace App\IdentityContext\Infrastructure\Persistence;

use App\IdentityContext\Domain\User\User;
use App\IdentityContext\Domain\User\Email;
use App\IdentityContext\Domain\User\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DoctrineUserRepository implements UserRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findById(int $id): ?User
    {
        return $this->entityManager->find(User::class, $id);
    }

    public function findByEmail(Email $email): ?User
    {
        return $this->entityManager->getRepository(User::class)
            ->findOneBy([
                'email.value' => $email
            ]);
    }
}
