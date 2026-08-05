<?php

namespace App\IdentityContext\Domain\User\Exception;

use App\IdentityContext\Domain\User\Email;

final class UserAlreadyExistsException extends \DomainException
{
    public function __construct(Email $email)
    {
        parent::__construct(sprintf('User with email "%s" already exists.', $email->value()));
    }
}
