<?php

namespace App\Cards\Infrastructure\External\FinanceAds;

use App\Cards\Domain\Entity\Card;
use App\Cards\Domain\Entity\Bank;
use App\Cards\Domain\Entity\CardType;
use App\Cards\Domain\Entity\ContentHash;
use App\Cards\Domain\Entity\Money;

class FinanceAdsCardAdapter
{
    public function toDomain(array $providerData): Card
    {
        $bank = Bank::create(
            $providerData['bankid'],
            $providerData['bank'],
            $providerData['logo']
        );

        $cardType = CardType::fromString(
            $this->mapCardType($providerData['cardtype']),
            $providerData['cardtype_text']
        );

        $card = Card::create(
            $providerData['produkt'],
            $providerData['description'],
            $bank,
            $cardType,
            ContentHash::fromContent($providerData)
        );

        if (isset($providerData['fees'])) {
            $card->setAnnualFee(Money::fromFloat($providerData['fees']));
        }

        if (isset($providerData['fees_first_year'])) {
            $card->setFirstYearFee(Money::fromFloat($providerData['fees_first_year']));
        }

        foreach ($providerData['benefits'] ?? [] as $benefit) {
            $card->addBenefit($benefit);
        }

        foreach ($providerData['insurance'] ?? [] as $insurance) {
            $card->addInsurance($insurance);
        }

        foreach ($providerData['services'] ?? [] as $service) {
            $card->addService($service);
        }

        return $card;
    }

    private function mapCardType(string $providerType): string
    {
        return match($providerType) {
            '0' => 'credit',
            'DC' => 'debit',
            'PP' => 'prepaid',
            default => throw new \InvalidArgumentException("Unknown card type: {$providerType}")
        };
    }
}