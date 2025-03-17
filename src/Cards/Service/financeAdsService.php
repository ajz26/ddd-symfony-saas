<?php 

namespace App\Cards\Service;

use App\Cards\Service\CardService;
use Doctrine\ORM\EntityManagerInterface;
use App\Cards\Repository\FinanceAdsRepository;
use Psr\Log\LoggerInterface;

/**
 * FinanceAdsService
 * 
 * @package App\Cards\Service
 */
class financeAdsService {
 

    public function __construct(private FinanceAdsRepository $financeAdsRepository, private CardService $cardService, private LoggerInterface $logger)
    {
    }


    /**
     * Get cards from financeads
     *
     * @return array
     */
    public function getCards()
    {
        return $this->financeAdsRepository->getCards();
    }


    /**
     * Sync cards from financeads
     *
     * @return void
     */
    public function syncCards()
    {

       try {
        $cards = $this->getCards();
        
        $cardsToUpdate = [];
        $cardsToCreate = [];
        $existingCards = [];

        // Primero agrupamos las tarjetas en lotes
        foreach ($cards as $cardDto) {
            $card = $this->cardService->findOneBy([
                'product_id' => $cardDto->product_id,
                'bank_id' => $cardDto->bank_id
            ]);

            if(!$card) {
                $cardsToCreate[] = $cardDto;
                continue;
            }

            if($cardDto->content_crc !== $card->getContentCrc()) {
                $cardsToUpdate[] = ['card' => $card, 'dto' => $cardDto];
                continue;
            }

            $existingCards[] = [
                'product_id' => $cardDto->product_id,
                'bank_id' => $cardDto->bank_id,
                'content_crc' => $cardDto->content_crc
            ];


        }

        // Actualizamos en lote
        if (!empty($cardsToUpdate)) {
            $updatedCards = $this->cardService->batchUpdate($cardsToUpdate);
        }

        // Creamos en lote
        if (!empty($cardsToCreate)) {
            $newCards = $this->cardService->batchCreate($cardsToCreate);
        }


        
        $this->logger->info('Sync cards',[
            'updated' => count($cardsToUpdate),
            'created' => count($cardsToCreate),
            'existing' => count($existingCards)
        ]);

        return [
            'updated' => count($cardsToUpdate),
            'created' => count($cardsToCreate),
            'existing' => count($existingCards)
        ];

       } catch (\Throwable $th) {
        //throw $th;

        $this->logger->error($th->getMessage(),[

        ]);
        
       }
    }


}