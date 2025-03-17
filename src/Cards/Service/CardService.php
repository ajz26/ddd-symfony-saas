<?php 
namespace App\Cards\Service;

use App\Cards\Entity\Card;
use App\Cards\Dtos\CardDto;
use App\Cards\Repository\CardRepository;
use Doctrine\ORM\EntityManagerInterface;

class CardService
{
    public function __construct(
        private CardRepository $cardRepository,
        private EntityManagerInterface $entityManager
    ) {
    }
    
    /**
     * Find one card by criteria
     * @param array $criteria
     */
    public function findOneBy(array $criteria) : Card|null
    {
        return $this->cardRepository->findOneBy($criteria);
    }


    /**
     * Undocumented function
     *
     * @param Card $card
     * @param CardDto $dto
     * @return Card
     */
    public function update(Card $card, CardDto $dto) : Card
    {
        $dto->link ? $card->setLink($dto->link) : null;
        $dto->logo ? $card->setLogo($dto->logo) : null;
        $dto->test_seal ? $card->setTestSeal($dto->test_seal) : null;
        $dto->bank_id ? $card->setBankId($dto->bank_id) : null;
        $dto->product_id ? $card->setProductId($dto->product_id) : null;
        $dto->description ? $card->setDescription($dto->description) : null;
        $dto->custom_description ? $card->setCustomDescription($dto->custom_description) : null;
        $dto->custom_product_name ? $card->setCustomProductName($dto->custom_product_name) : null;
        $dto->bank ? $card->setBank($dto->bank) : null;
        $dto->product ? $card->setProduct($dto->product) : null;
        $dto->rating ? $card->setRating($dto->rating) : null;
        $dto->evaluation_number ? $card->setEvaluationNumber($dto->evaluation_number) : null;
        $dto->incentive ? $card->setIncentive($dto->incentive) : null;
        $dto->fees ? $card->setFees($dto->fees) : null;
        $dto->cost ? $card->setCost($dto->cost) : null;
        $dto->bonusprogram ? $card->setBonusprogram($dto->bonusprogram) : null;
        $dto->insurance ? $card->setInsurance($dto->insurance) : null;
        $dto->benefits ? $card->setBenefits($dto->benefits) : null;
        $dto->services ? $card->setServices($dto->services) : null;
        $dto->special_features ? $card->setSpecialFeatures($dto->special_features) : null;
        $dto->fees_action ? $card->setFeesAction($dto->fees_action) : null;
        $dto->cost_action ? $card->setCostAction($dto->cost_action) : null;
        $dto->fees_first_year ? $card->setFeesFirstYear($dto->fees_first_year) : null;
        $dto->fees_after_first_year ? $card->setFeesAfterFirstYear($dto->fees_after_first_year) : null;
        $dto->gc_atmfree_domestic ? $card->setGcAtmfreeDomestic($dto->gc_atmfree_domestic) : null;
        $dto->gc_atmfree_international ? $card->setGcAtmfreeInternational($dto->gc_atmfree_international) : null;
        $dto->cc_atmfree_domestic ? $card->setCcAtmfreeDomestic($dto->cc_atmfree_domestic) : null;
        $dto->cc_atmfree_international ? $card->setCcAtmfreeInternational($dto->cc_atmfree_international) : null;
        $dto->incentive_amount ? $card->setIncentiveAmount($dto->incentive_amount) : null;
        $dto->interest_rate ? $card->setInterestRate($dto->interest_rate) : null;
        $dto->shall_interest_rate ? $card->setShallInterestRate($dto->shall_interest_rate) : null;
        $dto->cardtype ? $card->setCardtype($dto->cardtype) : null;
        $dto->cardtype_text ? $card->setCardtypeText($dto->cardtype_text) : null;
        $dto->cc_atmfree_euro ? $card->setCcAtmfreeEuro($dto->cc_atmfree_euro) : null;
        $dto->kkoffer ? $card->setKkoffer($dto->kkoffer) : null;
        $dto->custom_cost_action ? $card->setCustomCostAction($dto->custom_cost_action) : null;
        $dto->content_crc ? $card->setContentCrc($dto->content_crc) : null;
        $card->setUpdatedAt(new \DateTime());
        $this->cardRepository->save($card, true);

        return $card;
    }


    /**
     * 
     *
     * @param [type] $page
     * @param [type] $limit
     * @param [type] $sort_by
     * @param [type] $sort
     */
    public function paginate($page, $limit, $sort_by, $sort)
    {
        return $this->cardRepository->paginate($page, $limit, $sort_by, $sort);
    }

    /**
     * Actualiza múltiples tarjetas en lote
     *
     * @param array $cardsData Array de ['card' => Card, 'dto' => CardDto]
     * @return array Array de Cards actualizadas
     */
    public function batchUpdate(array $cardsData): array
    {
        $updatedCards = [];
        
        foreach ($cardsData as $data) {
            $card = $data['card'];
            $dto = $data['dto'];
            
            // Actualizar los campos necesarios
            $dto->link ? $card->setLink($dto->link) : null;
            $dto->logo ? $card->setLogo($dto->logo) : null;
            $dto->test_seal ? $card->setTestSeal($dto->test_seal) : null;
            $dto->bank_id ? $card->setBankId($dto->bank_id) : null;
            $dto->product_id ? $card->setProductId($dto->product_id) : null;
            $dto->description ? $card->setDescription($dto->description) : null;
            $dto->custom_description ? $card->setCustomDescription($dto->custom_description) : null;
            $dto->custom_product_name ? $card->setCustomProductName($dto->custom_product_name) : null;
            $dto->bank ? $card->setBank($dto->bank) : null;
            $dto->product ? $card->setProduct($dto->product) : null;
            $dto->rating ? $card->setRating($dto->rating) : null;
            $dto->evaluation_number ? $card->setEvaluationNumber($dto->evaluation_number) : null;
            $dto->incentive ? $card->setIncentive($dto->incentive) : null;
            $dto->fees ? $card->setFees($dto->fees) : null;
            $dto->cost ? $card->setCost($dto->cost) : null;
            $dto->bonusprogram ? $card->setBonusprogram($dto->bonusprogram) : null;
            $dto->insurance ? $card->setInsurance($dto->insurance) : null;
            $dto->benefits ? $card->setBenefits($dto->benefits) : null;
            $dto->services ? $card->setServices($dto->services) : null;
            $dto->special_features ? $card->setSpecialFeatures($dto->special_features) : null;
            $dto->fees_action ? $card->setFeesAction($dto->fees_action) : null;
            $dto->cost_action ? $card->setCostAction($dto->cost_action) : null;
            $dto->fees_first_year ? $card->setFeesFirstYear($dto->fees_first_year) : null;
            $dto->fees_after_first_year ? $card->setFeesAfterFirstYear($dto->fees_after_first_year) : null;
            $dto->gc_atmfree_domestic ? $card->setGcAtmfreeDomestic($dto->gc_atmfree_domestic) : null;
            $dto->gc_atmfree_international ? $card->setGcAtmfreeInternational($dto->gc_atmfree_international) : null;
            $dto->cc_atmfree_domestic ? $card->setCcAtmfreeDomestic($dto->cc_atmfree_domestic) : null;
            $dto->cc_atmfree_international ? $card->setCcAtmfreeInternational($dto->cc_atmfree_international) : null;
            $dto->incentive_amount ? $card->setIncentiveAmount($dto->incentive_amount) : null;
            $dto->interest_rate ? $card->setInterestRate($dto->interest_rate) : null;
            $dto->shall_interest_rate ? $card->setShallInterestRate($dto->shall_interest_rate) : null;
            $dto->cardtype ? $card->setCardtype($dto->cardtype) : null;
            $dto->cardtype_text ? $card->setCardtypeText($dto->cardtype_text) : null;
            $dto->cc_atmfree_euro ? $card->setCcAtmfreeEuro($dto->cc_atmfree_euro) : null;
            $dto->kkoffer ? $card->setKkoffer($dto->kkoffer) : null;
            $dto->custom_cost_action ? $card->setCustomCostAction($dto->custom_cost_action) : null;
            $dto->content_crc ? $card->setContentCrc($dto->content_crc) : null;
            $card->setUpdatedAt(new \DateTime());
            $this->cardRepository->save($card, false);
            // ... actualizar otros campos
            
            $updatedCards[] = $card;
        }
        
        // Hacer flush una sola vez para todas las actualizaciones
        $this->entityManager->flush();
        
        return $updatedCards;
    }

    /**
     * Crea múltiples tarjetas en lote
     *
     * @param array $cardDtos Array de CardDto
     * @return array Array de Cards creadas
     */
    public function batchCreate(array $cardDtos): array
    {
        $newCards = [];
        
        foreach ($cardDtos as $dto) {
            $card = new Card();
            $card->setLink($dto->link)
            ->setLogo($dto->logo)
            ->setTestSeal($dto->test_seal)
            ->setBankId($dto->bank_id)
            ->setProductId($dto->product_id)
            ->setDescription($dto->description)
            ->setBank($dto->bank)
            ->setProduct($dto->product)
            ->setRating($dto->rating)
            ->setEvaluationNumber($dto->evaluation_number)
            ->setIncentive($dto->incentive)
            ->setFees($dto->fees)
            ->setCost($dto->cost)
            ->setBonusprogram($dto->bonusprogram)
            ->setInsurance($dto->insurance)
            ->setBenefits($dto->benefits)
            ->setServices($dto->services)
            ->setSpecialFeatures($dto->special_features)
            ->setFeesAction($dto->fees_action)
            ->setCostAction($dto->cost_action)
            ->setFeesFirstYear($dto->fees_first_year)
            ->setFeesAfterFirstYear($dto->fees_after_first_year)
            ->setGcAtmfreeDomestic($dto->gc_atmfree_domestic)
            ->setGcAtmfreeInternational($dto->gc_atmfree_international)
            ->setCcAtmfreeDomestic($dto->cc_atmfree_domestic)
            ->setCcAtmfreeInternational($dto->cc_atmfree_international)
            ->setIncentiveAmount($dto->incentive_amount)
            ->setInterestRate($dto->interest_rate)
            ->setShallInterestRate($dto->shall_interest_rate)
            ->setCardtype($dto->cardtype)
            ->setCardtypeText($dto->cardtype_text)
            ->setCcAtmfreeEuro($dto->cc_atmfree_euro)
            ->setKkoffer($dto->kkoffer)
            ->setCustomCostAction($dto->custom_cost_action)
            ->setContentCrc($dto->content_crc)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
    
            $this->cardRepository->persist($card, false);
            $newCards[] = $card;
        }
        // Hacer flush una sola vez para todas las creaciones
        $this->cardRepository->flush();
        
        return $newCards;
    }

}   
