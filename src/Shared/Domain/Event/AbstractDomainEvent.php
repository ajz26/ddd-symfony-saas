<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

abstract class AbstractDomainEvent implements DomainEvent
{
    private \DateTimeImmutable $occurredOn;

    public function __construct()
    {
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }

    abstract public function eventName(): string;
    
    abstract public function toPrimitives(): array;
} 