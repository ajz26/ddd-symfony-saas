<?php declare(strict_types=1);

namespace App\Users\Domain\Entity;

use App\Shared\Domain\ValueObject\ClientId;
use App\Users\Domain\ValueObject\Email;
use App\Users\Domain\ValueObject\Password;
use DateTimeImmutable;

class User
{
    private string $id;
    private Email $email;
    private Password $password;
    private string $firstName;
    private string $lastName;
    private ClientId     $clientId;
    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt;

    public function __construct(
    ) {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function verifyPassword(string $plainPassword): bool
    {
        return $this->password->verify($plainPassword);
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function setPassword(Password $password): void
    {
        $this->password = $password;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setClientId(ClientId $clientId): void
    {
        $this->clientId = $clientId;
    }

  

    public function getClientId(): ClientId
    {
        return $this->clientId;
    }

    public function clientId(): ClientId
    {
        return $this->clientId;
    }
} 