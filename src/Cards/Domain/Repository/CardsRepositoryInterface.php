<?php 

namespace App\Cards\Domain\Repository;

use App\Cards\Domain\Entity\Card;


interface CardsRepositoryInterface
{
    public function findAll(): array;

    public function paginate(int $page, int $limit, string $sortBy, string $sort): array;

    public function save(Card $card): ?Card;

}