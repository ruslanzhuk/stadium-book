<?php

namespace App\IdentityContext\Domain\User\Exception;

final class InvalidEmailException extends \InvalidArgumentException
{
    public function __construct(string $email)
    {
        parent::__construct(sprintf('Invalid email address: %s', $email));
    }
}
