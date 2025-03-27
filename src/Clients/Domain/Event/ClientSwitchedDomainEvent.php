<?php

declare(strict_types=1);

namespace App\Clients\Domain\Event;

use App\Clients\Domain\Entity\Client;
use App\Shared\Domain\Event\AbstractDomainEvent;

final class ClientSwitchedDomainEvent extends AbstractDomainEvent
{
    public function __construct(
        private readonly Client $client,
        private readonly \DateTimeImmutable $switchedAt,
    ) {
        parent::__construct();
    }

    public static function fromClient(Client $client): self
    {
        return new self(
            $client,
            new \DateTimeImmutable()
        );
    }

    public function eventName(): string
    {
        return 'client.switched';
    }

    public function toPrimitives(): array
    {
        return [
            'client' => $this->client,
            'switchedAt' => $this->switchedAt
        ];
    }

    public function client(): Client
    {
        return $this->client;
    }

    public function switchedAt(): \DateTimeImmutable
    {
        return $this->switchedAt;
    }
}