<?php

namespace App\IdentityContext\Domain\User;

interface UserRepository
{
    public function save(User $user): void;

    /**
     * Returns only users who have not been deleted.
     */
    public function findById(int $id): ?User;

    /**
     * Returns only users who have not been deleted.
     */
    public function findByEmail(Email $email): ?User;

    /**
     * Checks for existence only among users who have not been deleted.
     */
    public function existsByEmail(Email $email): bool;

    public function remove(User $user): void;

}
