<?php 

declare(strict_types=1);

namespace App\Users\Domain\ValueObject;

final class Email
{
    private function __construct(
        private string $value
    ) {
        $this->ensureIsValidEmail($value);
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    private function ensureIsValidEmail(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the invalid email address: <%s>', self::class, $value)
            );
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
} 