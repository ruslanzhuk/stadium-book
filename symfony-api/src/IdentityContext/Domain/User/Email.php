<?php

namespace App\IdentityContext\Domain\User;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Embeddable]
final class Email
{
    #[ORM\Column(name: 'email', length: 180, unique: true)]
    private string $value;
    public function __construct(string $value)
    {
        $value = mb_strtolower(trim($value));

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email');
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Email $email): bool
    {
        return $this->value === $email->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
