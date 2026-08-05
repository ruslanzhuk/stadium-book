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
        return $this->entityManager->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.id = :id')
            ->andWhere('u.deletedAt IS NULL')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByEmail(Email $email): ?User
    {
        return $this->entityManager->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.email.value = :email')
            ->andWhere('u.deletedAt IS NULL')
            ->setParameter('email', $email->value())
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function existsByEmail(Email $email): bool
    {
        $count = (int) $this->entityManager->createQueryBuilder()
            ->select('count(u.id)')
            ->from(User::class, 'u')
            ->where('u.email.value = :email')
            ->andWhere('u.deletedAt IS NULL')
            ->setParameter('email', $email->value())
            ->getQuery()
            ->getSingleScalarResult();

        return $count > 0;
    }

    public function remove(User $user): void
    {
        $user->delete();
        $this->save($user);
    }
}
