<?php 

namespace App\Clients\Domain\Entity;

use App\Clients\Domain\Contracts\Client as ClientInterface;

class Client implements ClientInterface
{
    private $id;

    private $name;

    private $createdAt;

    private $updatedAt;

    public function __construct(
        string $name,
    ){
        $this->name = $name;

    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable {
        return $this->updatedAt;
    }
    
    

}
