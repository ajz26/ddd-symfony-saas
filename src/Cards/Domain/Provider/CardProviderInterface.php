<?php 

namespace App\Cards\Domain\Provider;

use App\Cards\Domain\Entity\Card;

interface CardProviderInterface
{
    /** @return array<Card> */
    public function getCards(): array;
} 