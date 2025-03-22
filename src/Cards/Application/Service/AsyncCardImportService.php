<?php

namespace App\Cards\Application\Service;

use App\Cards\Domain\Bus\CommandBusInterface;
use App\Cards\Domain\Message\ImportCardsMessage;

class AsyncCardImportService
{
    public function __construct(
        private readonly CommandBusInterface $commandBus
    ) {}

    public function dispatchImport(string $provider): void
    {
        $message = new ImportCardsMessage($provider);

        $this->commandBus->dispatch($message);
    }
} 