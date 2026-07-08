<?php

namespace App\IdentityContext\Domain\User;

interface UserRepository
{
    public function save(User $user): void;

    public function findById(int $id): ?User;
    public function findByEmail(Email $email): ?User;
}
