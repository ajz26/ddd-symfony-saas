<?php 

namespace App\Cards\Infrastructure\Persistence\Doctrine;

use App\Cards\Domain\Entity\Card;

class CardHydrator
{

    public function extract(Card $cardEntity): array
    {
        return [
            'id' => $cardEntity->getId(),
            'product_id' => $cardEntity->getProductId(),
            'bank_id' => $cardEntity->getBankId(),
            'description' => $cardEntity->getDescription(),
            'created_at' => $cardEntity->getCreatedAt(),
            'updated_at' => $cardEntity->getUpdatedAt(),
            'link' => $cardEntity->getLink(),
            'logo' => $cardEntity->getLogo(),
            'test_seal' => $cardEntity->getTestSeal(),
            'bank_id' => $cardEntity->getBankId(),
            'product_id' => $cardEntity->getProductId(),
            'description' => $cardEntity->getDescription(),
            'custom_description' => $cardEntity->getCustomDescription(),
            'custom_product_name' => $cardEntity->getCustomProductName(),
            'bank' => $cardEntity->getBank(),
            'product' => $cardEntity->getProduct(),
            'rating' => $cardEntity->getRating(),
            'evaluation_number' => $cardEntity->getEvaluationNumber(),
            'incentive' => $cardEntity->getIncentive(),
            'fees' => $cardEntity->getFees(),
            'cost' => $cardEntity->getCost(),
            'bonusprogram' => $cardEntity->getBonusprogram(),
            'insurance' => $cardEntity->getInsurance(),
            'benefits' => $cardEntity->getBenefits(),
            'services' => $cardEntity->getServices(),
            'special_features' => $cardEntity->getSpecialFeatures(),
            'fees_action' => $cardEntity->getFeesAction(),
            'cost_action' => $cardEntity->getCostAction(),
            'fees_first_year' => $cardEntity->getFeesFirstYear(),
            'fees_after_first_year' => $cardEntity->getFeesAfterFirstYear(),
            'gc_atmfree_domestic' => $cardEntity->getGcAtmfreeDomestic(),
            'gc_atmfree_international' => $cardEntity->getGcAtmfreeInternational(),
            'cc_atmfree_domestic' => $cardEntity->getCcAtmfreeDomestic(),
            'cc_atmfree_international' => $cardEntity->getCcAtmfreeInternational(),
            'incentive_amount' => $cardEntity->getIncentiveAmount(),
            'interest_rate' => $cardEntity->getInterestRate(),
            'shall_interest_rate' => $cardEntity->getShallInterestRate(),
            'cardtype' => $cardEntity->getCardtype(),
            'cardtype_text' => $cardEntity->getCardtypeText(),
            'cc_atmfree_euro' => $cardEntity->getCcAtmfreeEuro(),
            'kkoffer' => $cardEntity->getKkoffer(),
            'custom_cost_action' => $cardEntity->getCustomCostAction(),
            'content_crc' => $cardEntity->getContentCrc(),
        ];
    }

    public function hydrate(array $data, Card $card): Card
    {
        if($data['link'])  $card->setLink($data['link']);
        if($data['logo'])  $card->setLogo($data['logo']);
        if($data['test_seal'])  $card->setTestSeal($data['test_seal']);
        if($data['bank_id'])  $card->setBankId($data['bank_id']);
        if($data['product_id'])  $card->setProductId($data['product_id']);
        if($data['description'])  $card->setDescription($data['description']);
        if($data['custom_description'])  $card->setCustomDescription($data['custom_description']);
        if($data['custom_product_name'])  $card->setCustomProductName($data['custom_product_name']);
        if($data['bank'])  $card->setBank($data['bank']);
        if($data['product'])  $card->setProduct($data['product']);
        if($data['rating'])  $card->setRating($data['rating']);
        if($data['evaluation_number'])  $card->setEvaluationNumber($data['evaluation_number']);
        if($data['incentive'])  $card->setIncentive($data['incentive']);
        if($data['fees'])  $card->setFees($data['fees']);
        if($data['cost'])  $card->setCost($data['cost']);
        if($data['bonusprogram'])  $card->setBonusprogram($data['bonusprogram']);
        if($data['insurance'])  $card->setInsurance($data['insurance']);
        if($data['benefits'])  $card->setBenefits($data['benefits']);
        if($data['services'])  $card->setServices($data['services']);
        if($data['special_features'])  $card->setSpecialFeatures($data['special_features']);
        if($data['fees_action'])  $card->setFeesAction($data['fees_action']);
        if($data['cost_action'])  $card->setCostAction($data['cost_action']);
        if($data['fees_first_year'])  $card->setFeesFirstYear($data['fees_first_year']);
        if($data['fees_after_first_year'])  $card->setFeesAfterFirstYear($data['fees_after_first_year']);
        if($data['gc_atmfree_domestic'])  $card->setGcAtmfreeDomestic($data['gc_atmfree_domestic']);
        if($data['gc_atmfree_international'])  $card->setGcAtmfreeInternational($data['gc_atmfree_international']);
        if($data['cc_atmfree_domestic'])  $card->setCcAtmfreeDomestic($data['cc_atmfree_domestic']);
        if($data['cc_atmfree_international'])  $card->setCcAtmfreeInternational($data['cc_atmfree_international']);
        if($data['incentive_amount'])  $card->setIncentiveAmount($data['incentive_amount']);
        if($data['interest_rate'])  $card->setInterestRate($data['interest_rate']);
        if($data['shall_interest_rate'])  $card->setShallInterestRate($data['shall_interest_rate']);
        if($data['cardtype'])  $card->setCardtype($data['cardtype']);
        if($data['cardtype_text'])  $card->setCardtypeText($data['cardtype_text']);
        if($data['cc_atmfree_euro'])  $card->setCcAtmfreeEuro($data['cc_atmfree_euro']);
        if($data['kkoffer'])  $card->setKkoffer($data['kkoffer']);
        if($data['custom_cost_action'])  $card->setCustomCostAction($data['custom_cost_action']);
        if($data['content_crc'])  $card->setContentCrc($data['content_crc']);
        
        return $card;
    }
    
}