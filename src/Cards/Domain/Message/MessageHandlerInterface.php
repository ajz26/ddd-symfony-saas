<?php

namespace App\Cards\Domain\Message;

interface MessageHandlerInterface
{
    public function handle(Message $message): mixed;
} 