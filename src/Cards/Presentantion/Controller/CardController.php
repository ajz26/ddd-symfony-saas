<?php 

namespace App\Cards\Presentantion\Controller;

use Symfony\Component\Routing\Attribute\Route;
use App\Cards\Application\Service\CardApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CardController extends AbstractController
{
    #[Route('/', name: 'app_cards_index', methods: ['GET'])]
    public function index(CardApplicationService $cardApplicationService)
    {
        $cards = $cardApplicationService->paginate(1, 10, 'created_at', 'DESC');
        return $this->json($cards);
    }   
}
