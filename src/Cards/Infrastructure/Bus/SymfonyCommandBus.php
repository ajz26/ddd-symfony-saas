<?php

namespace App\Cards\Infrastructure\Bus;

use App\Cards\Domain\Bus\CommandBusInterface;
use App\Cards\Domain\Message\Message;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyCommandBus implements CommandBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    ) {}

    public function dispatch(Message $message): void
    {
        $this->messageBus->dispatch($message);
    }
} 