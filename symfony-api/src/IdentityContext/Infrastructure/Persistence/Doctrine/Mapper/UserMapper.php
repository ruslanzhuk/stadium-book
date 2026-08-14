<?php

namespace App\IdentityContext\Infrastructure\Persistence\Doctrine\Mapper;

use App\IdentityContext\Domain\User\Email;
use App\IdentityContext\Domain\User\PasswordHash;
use App\IdentityContext\Domain\User\User;
use App\IdentityContext\Infrastructure\Persistence\Doctrine\Entity\UserEntity;

final class UserMapper
{
    public function toDomain(UserEntity $entity): User
    {
        return User::reconstitute(
            id: $entity->id(),
            email: new Email($entity->email()),
            passwordHash: new PasswordHash($entity->passwordHash()),
            firstName: $entity->firstName(),
            lastName: $entity->lastName(),
            roles: $entity->roles(),
            createdAt: $entity->createdAt(),
            updatedAt: $entity->updatedAt(),
            deletedAt: $entity->deletedAt(),
            emailVerifiedAt: $entity->emailVerifiedAt(),
        );
    }

    public function toEntity(User $user, ?UserEntity $entity): UserEntity
    {
        $entity ??= new UserEntity();

        $entity->setEmail((string) $user->email());
        $entity->setPasswordHash((string) $user->passwordHash());
        $entity->setFirstName($user->firstName());
        $entity->setLastName($user->lastName());
        $entity->setRoles($user->roles());
        $entity->setCreatedAt($user->createdAt());
        $entity->setUpdatedAt($user->updatedAt());
        $entity->setDeletedAt($user->deletedAt());
        $entity->setEmailVerifiedAt($user->emailVerifiedAt());

        return $entity;
    }
}
