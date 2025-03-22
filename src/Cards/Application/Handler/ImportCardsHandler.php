<?php

namespace App\Cards\Application\Handler;

use App\Cards\Domain\Message\Message;
use App\Cards\Domain\Message\MessageHandlerInterface;
use App\Cards\Domain\Message\ImportCardsMessage;
use App\Cards\Application\Service\CardImportService;

class ImportCardsHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly CardImportService $cardImportService
    ) {}

    public function handle(Message $message): mixed
    {
        if (!$message instanceof ImportCardsMessage) {
            throw new \InvalidArgumentException('Invalid message type');
        }

        return $this->cardImportService->importCards($message->getProvider());
    }
} 