<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Event;

use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\Event\EventDispatcher;
use App\Shared\Domain\Event\DomainEventSubscriber;

final class DomainEventDispatcher implements EventDispatcher
{
    private array $subscribers = [];

    public function __construct(iterable $subscribers = [])
    {
        foreach ($subscribers as $subscriber) {
            if (!$subscriber instanceof DomainEventSubscriber) {
                throw new \InvalidArgumentException(sprintf(
                    'Subscriber must implement %s interface',
                    DomainEventSubscriber::class
                ));
            }

            $this->addSubscriber($subscriber);
        }
    }

    private function addSubscriber(DomainEventSubscriber $subscriber): void
    {
        $subscribedEvents = $subscriber::subscribedTo();

        foreach ($subscribedEvents as $eventClass) {
            if (!isset($this->subscribers[$eventClass])) {
                $this->subscribers[$eventClass] = [];
            }
            $this->subscribers[$eventClass][] = $subscriber;
        }
    }

    public function dispatch(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            $eventClass = get_class($event);

            if (!isset($this->subscribers[$eventClass])) {
                continue;
            }

            foreach ($this->subscribers[$eventClass] as $subscriber) {
                $subscriber->handle($event);
            }
        }
    }
} 