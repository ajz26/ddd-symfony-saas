<?php

namespace App\Cards\Domain\Message;

class ImportCardsMessage implements Message
{
    public function __construct(
        private readonly string $provider,
        private readonly array $options = []
    ) {
    }

    public function getMessageType(): string
    {
        return 'import_cards';
    }

    public function getPayload(): array
    {
        return [
            'provider' => $this->provider,
            'options' => $this->options
        ];
    }

    public function getProvider(): string 
    {
        return $this->provider;
    }
} 