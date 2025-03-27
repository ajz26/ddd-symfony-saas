<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

use App\Shared\Domain\Event\DomainEvent;

interface DomainEventSubscriber
{
    public static function subscribedTo(): array;
    
    public function handle(DomainEvent $event): void;
} 