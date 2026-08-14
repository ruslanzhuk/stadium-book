<?php

namespace App\IdentityContext\Infrastructure\Persistence\Doctrine\Repository;

use App\IdentityContext\Domain\User\User;
use App\IdentityContext\Domain\User\Email;
use App\IdentityContext\Domain\User\UserRepository;
use App\IdentityContext\Infrastructure\Persistence\Doctrine\Entity\UserEntity;
use App\IdentityContext\Infrastructure\Persistence\Doctrine\Mapper\UserMapper;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DoctrineUserRepository implements UserRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserMapper $mapper,
    ) {
    }

    public function save(User $user): void
    {
        $entity = null;

        if($user->id() !== null) {
            $entity = $this->entityManager->getRepository(UserEntity::class)
                ->find($user->id());
        }

        $entity = $this->mapper->toEntity($user, $entity);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function findById(int $id): ?User
    {
        $entity = $this->entityManager
            ->createQueryBuilder()
            ->select('u')
            ->from(UserEntity::class, 'u')
            ->where('u.id = :id')
            ->andWhere('u.deletedAt IS NULL')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if ($entity === null) {
            return null;
        }

        return $this->mapper->toDomain($entity);
    }

    public function findByEmail(Email $email): ?User
    {
        $entity = $this->entityManager
            ->createQueryBuilder()
            ->select('u')
            ->from(UserEntity::class, 'u')
            ->where('u.email = :email')
            ->andWhere('u.deletedAt IS NULL')
            ->setParameter('email', $email->value())
            ->getQuery()
            ->getOneOrNullResult();

        if ($entity === null) {
            return null;
        }

        return $this->mapper->toDomain($entity);
    }

    public function existsByEmail(Email $email): bool
    {
        $count = (int) $this->entityManager
            ->createQueryBuilder()
            ->select('COUNT(u.id)')
            ->from(UserEntity::class, 'u')
            ->where('u.email = :email')
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
