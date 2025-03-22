<?php

namespace App\Cards\Domain\Entity;

use App\Cards\Domain\Entity\Money;
use App\Cards\Domain\Entity\CardType;
use App\Cards\Domain\Entity\Bank;
use App\Cards\Domain\Entity\ContentHash;

class Card
{
    private int $id;
    private string $name;
    private string $description;
    private ?string $customDescription;
    private Bank $bank;
    private CardType $type;
    private Money $firstYearFee;
    private float $tae;
    private array $benefits;
    private array $insurances;
    private array $services;
    private ContentHash $contentHash;
    private \DateTimeImmutable $createdAt;
    private ?\DateTimeImmutable $updatedAt;
    
    private function __construct(
        string $name,
        string $description,
        Bank $bank,
        CardType $type,
        ContentHash $contentHash
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->bank = $bank;
        $this->type = $type;
        $this->contentHash = $contentHash;
        $this->benefits = [];
        $this->insurances = [];
        $this->services = [];
        $this->firstYearFee = Money::fromFloat(0);
        $this->tae = 0;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public static function create(
        string $name,
        string $description,
        Bank $bank,
        CardType $type,
        ContentHash $contentHash
    ): self {
        return new self(
            $name,
            $description,
            $bank,
            $type,
            $contentHash
        );
    }

    public function update(
        string $name,
        string $description,
        CardType $type,
        ContentHash $contentHash
    ): void {
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->contentHash = $contentHash;
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function setCustomDescription(?string $description): void
    {
        $this->customDescription = $description;
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function setFirstYearFee(Money $fee): void
    {
        $this->firstYearFee = $fee;
    }

    public function getFirstYearFee(): Money
    {
        return $this->firstYearFee;
    }
    public function addBenefit(string $benefit): void
    {
        $this->benefits[] = $benefit;
    }

    public function addInsurance(string $insurance): void
    {
        $this->insurances[] = $insurance;
    }

    public function addService(string $service): void
    {
        $this->services[] = $service;
    }

    public function hasContentChanged(ContentHash $newContentHash): bool
    {
        return !$this->contentHash->equals($newContentHash);
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCustomDescription(): ?string
    {
        return $this->customDescription;
    }

    public function getBank(): Bank
    {
        return $this->bank;
    }

    public function getType(): CardType
    {
        return $this->type;
    }

    public function getContentHash(): ContentHash
    {
        return $this->contentHash;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getTae(): float
    {
        return $this->tae;
    }

    public function setTae(float $tae): void
    {
        $this->tae = $tae;
    }

    public function getBenefits(): array
    {
        return $this->benefits;
    }

}