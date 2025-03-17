<?php

namespace App\Api\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/')]
class BaseController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $message = 'API is running, use /api/v1/cards to get the cards';
        $version = '1.0.0';
        $urls = [
            'cards' => [
                'GET' => '/api/v1/cards',
                'PUT' => '/api/v1/cards/{id}',
                'POST' => '/api/v1/cards/sync',
            ],
        ];  
        return $this->json(['message' => $message, 'version' => $version, 'urls' => $urls]);
    }
}
