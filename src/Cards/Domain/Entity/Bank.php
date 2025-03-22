<?php

namespace App\Cards\Domain\Entity;

class Bank
{
    private string $id;
    private string $name;
    private string $logo;

    private function __construct(string $id, string $name, string $logo)
    {
        $this->id = $id;
        $this->name = $name;
        $this->logo = $logo;
    }

    public static function create(string $id, string $name, string $logo): self
    {
        return new self($id, $name, $logo);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }
} 