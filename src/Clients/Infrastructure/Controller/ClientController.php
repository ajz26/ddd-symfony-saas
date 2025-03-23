<?php 

namespace App\Clients\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Clients\Application\Service\ClientApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    public function __construct(
        private readonly ClientApplicationService $clientApplicationService,
    )
    {
    }


    #[Route('/', name: 'clients.index')]
    public function index(Request $request): JsonResponse
    {
        $page = $request->query->get('page', 1);
        $perPage = $request->query->get('perPage', 10);

        $clients = $this->clientApplicationService->paginate($page, $perPage);

        return $this->json($clients);
    }
}