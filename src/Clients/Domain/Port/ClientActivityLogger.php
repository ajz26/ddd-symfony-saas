<?php

declare(strict_types=1);

namespace App\Clients\Domain\Port;

use App\Clients\Domain\Entity\Client;

interface ClientActivityLogger
{
    public function logClientSwitch(Client $client, \DateTimeImmutable $switchedAt): void;
} 