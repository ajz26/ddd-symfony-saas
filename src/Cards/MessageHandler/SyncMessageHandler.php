<?php 

namespace App\Cards\MessageHandler;

use Psr\Log\LoggerInterface;
use App\Cards\Message\SyncMessage;
use App\Cards\Service\financeAdsService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SyncMessageHandler
{

    public function __construct(private financeAdsService $financeAdsService, private LoggerInterface $logger)
    {
    }

    public function __invoke(SyncMessage $message)
    {
        $this->logger->info('syncing cards');
        $this->financeAdsService->syncCards();
        $this->logger->info('cards synced');
    }
}