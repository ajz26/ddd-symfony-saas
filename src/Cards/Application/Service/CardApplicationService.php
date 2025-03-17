<?php 

namespace App\Cards\Application\Service;

use App\Cards\Domain\Repository\CardsRepositoryInterface;

class CardApplicationService
{
    public function __construct(private CardsRepositoryInterface $cardsRepository)
    {
    }

    /**
     * Paginate the cards
     *
     * @param integer $page
     * @param integer $limit
     * @param string $sortBy
     * @param string $sort
     * @return array
     */
    public function paginate(int $page, int $limit, string $sortBy, string $sort): array
    {
        return $this->cardsRepository->paginate($page, $limit, $sortBy, $sort);
    } 

}