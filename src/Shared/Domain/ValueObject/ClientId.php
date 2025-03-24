<?php

namespace App\Shared\Domain\ValueObject;

final class ClientId
{

    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(ClientId $other): bool
    {
        return $this->value === $other->value;
    }

    public static function fromString(string $value): self
    {
        return new self((int) $value);
    }

    public static function fromInt(int $value): self
    {
        return new self($value);
    }
}