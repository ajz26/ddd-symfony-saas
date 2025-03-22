<?php

namespace App\Cards\Application\Service;

use App\Cards\Domain\Repository\CardsRepositoryInterface;
use App\Cards\Infrastructure\External\Factory\CardProviderFactory;
use App\Cards\Domain\Service\CardHydrator;

class CardImportService
{

    public function __construct(
        private readonly CardProviderFactory $cardProviderFactory,
        private readonly CardsRepositoryInterface $cardRepository,
        private readonly CardHydrator $cardHydrator
    ) {}

    public function importCards(string $provider)
    {

        

        try {

            $provider = $this->cardProviderFactory->create($provider);

            $cards = $provider->getCards();

            
            $cardsToUpdate = [];
            $cardsToCreate = [];
            $existingCards = [];

            $batch = [];
    
            // Primero agrupamos las tarjetas en lotes
            foreach ($cards as $card) {
                
                $_card = $this->cardRepository->findOneBy([
                    "bank.id" => $card->getBank()->getId()
                ], []);

            
                if(!$_card) {
                    $cardsToCreate[] = $card;
                    $batch[] = $card;
                    continue;
                }

    
                if($_card->hasContentChanged($card->getContentHash())) {
                    // Usamos el hydrator para mergear los datos
                    $this->cardHydrator->hydrate($card, $_card);
                    
                    $cardsToUpdate[] = $_card;
                    $batch[] = $_card;
                    continue;
                }
    
                $existingCards[] = [
                    'name' => $card->getName(),
                    'bank_id' => $card->getBank()->getId(),
                    'content_hash' => $card->getContentHash()->getValue()
                ];
            }

            // Actualizamos en lote
            $this->cardRepository->persistBatch($batch);
    
            return [
                'updated' => count($cardsToUpdate),
                'created' => count($cardsToCreate),
                'existing' => count($existingCards)
            ];
    
           } catch (\Throwable $th) {
            throw $th;
           }
    }
}