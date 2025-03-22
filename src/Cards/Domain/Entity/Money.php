<?php

namespace App\Cards\Domain\Entity;

class Money
{
    private float $amount;
    private string $currency;

    private function __construct(float $amount, string $currency = 'EUR')
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Money amount cannot be negative');
        }

        $this->amount = round($amount, 2);
        $this->currency = $currency;
    }

    public static function fromFloat(float $amount, string $currency = 'EUR'): self
    {
        return new self($amount, $currency);
    }

    public static function zero(string $currency = 'EUR'): self
    {
        return new self(0.0, $currency);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function equals(Money $other): bool
    {
        return $this->amount === $other->amount 
            && $this->currency === $other->currency;
    }

    public function add(Money $other): self
    {
        if ($this->currency !== $other->currency) {
            throw new \InvalidArgumentException('Cannot add money with different currencies');
        }

        return new self($this->amount + $other->amount, $this->currency);
    }

    public function subtract(Money $other): self
    {
        if ($this->currency !== $other->currency) {
            throw new \InvalidArgumentException('Cannot subtract money with different currencies');
        }

        return new self($this->amount - $other->amount, $this->currency);
    }

    public function multiply(float $factor): self
    {
        return new self($this->amount * $factor, $this->currency);
    }

    public function isGreaterThan(Money $other): bool
    {
        $this->assertSameCurrency($other);
        return $this->amount > $other->amount;
    }

    public function isLessThan(Money $other): bool
    {
        $this->assertSameCurrency($other);
        return $this->amount < $other->amount;
    }

    private function assertSameCurrency(Money $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new \InvalidArgumentException('Cannot compare money with different currencies');
        }
    }

    public function __toString(): string
    {
        return sprintf('%.2f %s', $this->amount, $this->currency);
    }
}