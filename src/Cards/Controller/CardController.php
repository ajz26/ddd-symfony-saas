<?php

namespace App\Cards\Controller;

use App\Cards\Dtos\CardDto;
use App\Cards\Message\SyncMessage;
use App\Cards\Service\CardService;
use App\Cards\Service\financeAdsService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[Route('/')]
class CardController extends AbstractController
{

    /**
     * Get Cards by page, limit, sort_by, sort
     *
     * @param Request $request
     * @param CardService $cardService
     * @return Response
     */
    #[Route('/', name: 'index')]
    public function index( Request $request,  CardService $cardService): Response
    {

        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 10);
        $sort_by = $request->query->get('sort_by', 'id');
        $sort = $request->query->get('sort', 'asc');

        $cards = $cardService->paginate($page, $limit, $sort_by, $sort);

        $response = $this->json($cards);

        $response->setCache([
            'etag' => md5($response->getContent()),
            'max_age' => 3600,
            's_maxage' => 3600,
            'public' => true,
        ]);
        
        return $response;
    }



    /**
     * Sync Cards
     *
     * @param financeAdsService $financeAdsService
     * @return Response
     */
    #[Route('/sync', name: 'sync', methods: ['POST', 'GET'])] 
    public function sync(Request $request, MessageBusInterface $bus, financeAdsService $financeAdsService): Response
    {
        $data = json_decode($request->getContent(), true);

        $async = isset($data['async']) ? $data['async'] : $request->query->get('async', false);

        if ($async) {
            $bus->dispatch(new SyncMessage());
            return $this->json(['message' => 'Cards sync started']);
        } else {
           $count = $financeAdsService->syncCards();
           return $this->json(['message' => 'Cards synced', 'count' => $count]);
        }

        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);
        return $response;
    }

    /**
     * Update Card
     *
     * @param int $id
     * @param Request $request
     * @param CardService $cardService
     * @return Response
     */
    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(int $id, Request $request, CardService $cardService): Response
    {
        $card = $cardService->findOneBy(['id' => $id]); 

        if (!$card) {
            throw new NotFoundHttpException('Card not found');
        }
        
        try {
            $data = $request->toArray();
            
            if (!isset($data['customProductName']) && !isset($data['customDescription']) && !isset($data['customCostAction'])) {
                throw new BadRequestHttpException('Missing required fields');
            }

            $card = $cardService->update($card, new CardDto(
                custom_product_name: $data['customProductName'],
                custom_description: $data['customDescription'],
                custom_cost_action: $data['customCostAction']
            ));

            return $this->json($card);
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
}