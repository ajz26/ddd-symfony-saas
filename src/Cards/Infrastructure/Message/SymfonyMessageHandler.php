<?php

namespace App\Cards\Infrastructure\Message;

use App\Cards\Domain\Message\Message;
use App\Cards\Domain\Message\MessageHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SymfonyMessageHandler
{
    public function __construct(
        private readonly MessageHandlerInterface $handler
    ) {}

    public function __invoke(Message $message)
    {
        return $this->handler->handle($message);
    }
} 