<?php

declare(strict_types=1);

namespace App\Users\Domain\ValueObject;

final class Password
{
    private function __construct(
        private string $hashedValue
    ) {
    }

    public static function fromPlainPassword(string $plainPassword): self
    {
        if (strlen($plainPassword) < 6) {
            throw new \InvalidArgumentException('La contraseña debe tener al menos 6 caracteres');
        }

        return new self(password_hash($plainPassword, PASSWORD_ARGON2ID));
    }

    public static function fromHash(string $hashedPassword): self
    {
        return new self($hashedPassword);
    }

    public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hashedValue);
    }

    public function value(): string
    {
        return $this->hashedValue;
    }
} 