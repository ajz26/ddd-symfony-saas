<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Users\Infrastructure\Security\SecurityUser;
use App\Users\Application\Service\AuthenticationService;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Users\Domain\Exception\InvalidCredentialsException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AuthController extends AbstractController
{
    public function __construct(
        private readonly AuthenticationService $authService
    ) {
    }

    #[Route('/login', name: 'auth.login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        try {
            $content = json_decode($request->getContent(), true);

            if (!isset($content['email']) || !isset($content['password'])) {
                return new JsonResponse(
                    ['error' => 'Email y contraseña son requeridos'],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $result = $this->authService->authenticate(
                $content['email'],
                $content['password']
            );

            return new JsonResponse($result);

        } catch (InvalidCredentialsException $e) {
            return new JsonResponse(
                ['error' => $e->getMessage()],
                Response::HTTP_UNAUTHORIZED
            );
        } catch (\JsonException $e) {
            return new JsonResponse(
                ['error' => 'Invalid JSON format'],
                Response::HTTP_BAD_REQUEST
            );
        }
    }


    #[Route('/me', name: 'auth.me', methods: ['GET'])]
    public function me(#[CurrentUser] ?SecurityUser $securityUser): JsonResponse
    {
        if (!$securityUser) {
            return new JsonResponse(
                ['error' => 'No autenticado'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $user = $securityUser->getUser();

        return new JsonResponse([
            'id' => $user->id(),
            'email' => $user->email()->value(),
            'firstName' => $user->firstName(),
            'lastName' => $user->lastName()
        ]);
    }
}