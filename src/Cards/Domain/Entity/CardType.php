<?php

namespace App\Cards\Domain\Entity;

class CardType
{
    private const VALID_TYPES = ['credit', 'debit', 'prepaid'];
    
    private string $type;
    private string $displayName;

    private function __construct(string $type, string $displayName)
    {
        if (!in_array($type, self::VALID_TYPES)) {
            throw new \InvalidArgumentException("Invalid card type: {$type}");
        }
        
        $this->type = $type;
        $this->displayName = $displayName;
    }

    public static function fromString(string $type, string $displayName): self
    {
        return new self($type, $displayName);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }
}