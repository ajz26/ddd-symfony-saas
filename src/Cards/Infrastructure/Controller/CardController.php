<?php 

namespace App\Cards\Infrastructure\Controller;

use Symfony\Component\Routing\Attribute\Route;
use App\Cards\Application\Service\CardApplicationService;
use App\Cards\Application\Service\CardImportService;
use App\Cards\Application\Service\AsyncCardImportService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CardController extends AbstractController
{
    #[Route('/', name: 'app_cards_index', methods: ['GET'])]
    public function index(CardApplicationService $cardApplicationService)
    {
        $cards = $cardApplicationService->paginate(1, 10, 'createdAt', 'DESC');
        return $this->json($cards);
    }   


    #[Route('/import/{provider}', name: 'app_cards_import', methods: ['GET'])]
    public function import(AsyncCardImportService $asyncCardImportService, CardImportService $card_import_service, string $provider)
    {
        // $cards = $card_import_service->importCards($provider);
        $test = $asyncCardImportService->dispatchImport($provider);
        return $this->json(['message' => 'Import started']);
    }
}
