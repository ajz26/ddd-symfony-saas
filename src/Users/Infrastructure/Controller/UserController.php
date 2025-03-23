<?php 

declare(strict_types=1);

namespace App\Users\Infrastructure\Controller;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Service\UserHydrator;
use App\Users\Application\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


final class UserController extends AbstractController
{
    public function __construct(
        private UserService $userService,
        private UserHydrator $userHydrator
    ) {
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