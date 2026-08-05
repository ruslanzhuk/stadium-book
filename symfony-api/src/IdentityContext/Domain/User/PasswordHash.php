<?php

namespace App\IdentityContext\Domain\User;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Embeddable]
final readonly class PasswordHash
{
    #[ORM\Column(name: 'password_hash', length: 255)]
    private string $value;

    public function __construct(string $value)
    {
        if ($value === '') {
            throw new \InvalidArgumentException('Password hash cannot be empty.');
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(PasswordHash $other): bool
    {
        return $this->value === $other->value;
    }
}
