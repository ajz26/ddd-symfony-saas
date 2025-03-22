<?php

namespace App\Cards\Domain\Bus;

use App\Cards\Domain\Message\Message;

interface CommandBusInterface
{
    public function dispatch(Message $message): void;
} 