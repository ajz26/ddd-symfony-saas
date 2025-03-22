<?php
namespace App\Cards\Infrastructure\External\Factory;

use App\Cards\Domain\Provider\CardProviderInterface;
use App\Cards\Infrastructure\External\FinanceAds\FinanceAdsProvider;

class CardProviderFactory
{
    private array $providers;

    public function __construct(
        private readonly FinanceAdsProvider $financeAdsProvider,
    ) {
        $this->providers = [
            'finance_ads' => $financeAdsProvider,
        ];
    }

    public function create(string $provider): CardProviderInterface
    {
        if (!isset($this->providers[$provider])) {
            throw new \Exception("Provider '$provider' not found");
        }

        return $this->providers[$provider];
    }

}