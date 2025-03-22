<?php

namespace App\Cards\Domain\Message;

interface Message
{
    public function getMessageType(): string;
    public function getPayload(): array;
} 