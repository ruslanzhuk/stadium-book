<?php

namespace App\IdentityContext\Domain\User\Exception;

final class UserNotFoundException extends \DomainException
{
    public function __construct(int $userId)
    {
        parent::__construct(sprintf('User with id "%s" not found.', $userId));
    }
}
