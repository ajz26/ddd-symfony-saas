<?php

namespace App\Cards\Domain\Entity;

class ContentHash   
{
    private string $hash;

    private function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public static function fromContent(array $content): self
    {
        return new self(md5(serialize($content)));
    }

    public function equals(ContentHash $other): bool
    {
        return $this->hash === $other->hash;
    }

    public function getValue(): string
    {
        return $this->hash;
    }
}