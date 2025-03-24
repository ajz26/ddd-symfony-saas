<?php declare(strict_types=1);

namespace App\Users\Domain\Entity;

use App\Users\Domain\ValueObject\Email;
use App\Users\Domain\ValueObject\UserId;
use App\Users\Domain\ValueObject\Password;
use DateTimeImmutable;

class User
{
    private string $id;
    private Email $email;
    private Password $password;
    private string $firstName;
    private string $lastName;
    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt;

    public function __construct(
    ) {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }


    public function id(): string
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function verifyPassword(string $plainPassword): bool
    {
        return $this->password->verify($plainPassword);
    }

    public function getPassword(): ?string
    {
        return $this->password->value();
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function fullName(): string
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeImmutable
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
} 