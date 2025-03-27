<?php

declare(strict_types=1);

namespace App\Clients\Infrastructure\Logger;

use App\Clients\Domain\Entity\Client;
use App\Clients\Domain\Port\ClientActivityLogger;
use Psr\Log\LoggerInterface;

final class PsrClientActivityLogger implements ClientActivityLogger
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function logClientSwitch(Client $client, \DateTimeImmutable $switchedAt): void
    {
        $this->logger->info(
            'Cliente cambiado',
            [
                'client_id' => $client->getId(),
                'switched_at' => $switchedAt->format('Y-m-d H:i:s')
            ]
        );
    }
} 