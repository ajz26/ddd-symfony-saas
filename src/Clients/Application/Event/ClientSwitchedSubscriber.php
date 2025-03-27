<?php

declare(strict_types=1);

namespace App\Clients\Application\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Clients\Domain\Port\ClientActivityLogger;
use App\Shared\Domain\Event\DomainEventSubscriber;
use App\Clients\Domain\Event\ClientSwitchedDomainEvent;

final class ClientSwitchedSubscriber implements DomainEventSubscriber
{
    public function __construct(
        private readonly ClientActivityLogger $activityLogger
    ) {}

    public static function subscribedTo(): array
    {
        return [
            ClientSwitchedDomainEvent::class
        ];
    }

    public function handle(DomainEvent $event): void
    {
        if (!$event instanceof ClientSwitchedDomainEvent) {
            return;
        }


        $this->activityLogger->logClientSwitch(
            $event->client(),
            $event->switchedAt()
        );
    }
} 