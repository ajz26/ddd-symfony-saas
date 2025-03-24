<?php 

declare(strict_types=1);

namespace App\Users\Infrastructure\Controller;

use App\Clients\Domain\Entity\Client;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Service\UserHydrator;
use Symfony\Component\HttpFoundation\Request;
use App\Users\Application\Service\UserService;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Shared\Infrastructure\Attribute\CurrentClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


final class UserController extends AbstractController
{
    public function __construct(
        private UserService $userService,
        private UserHydrator $userHydrator
    ) {
    }

    #[Route('/', name: 'user_list', methods: ['GET'])]
    public function listUsers(Request $request, #[CurrentClient] Client $clientId): JsonResponse
    {

        dd($clientId);
        $page = $request->query->get('page', 1);
        $limit = $request->query->get('limit', 10);


        $users = $this->userService->paginate($page, $limit);

        return new JsonResponse($users);
    }

    #[Route('/', name: 'user_create', methods: ['POST'])]
    public function createUser(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $this->userHydrator->hydrateFromArray($data, new User());

        $user = $this->userService->createUser($user);


        return new JsonResponse($user);
    }
}