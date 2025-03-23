<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Controller;

use App\Users\Application\Service\AuthenticationService;
use App\Users\Domain\Exception\InvalidCredentialsException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AuthController extends AbstractController
{
    public function __construct(
        private readonly AuthenticationService $authService
    ) {
    }

    #[Route('/login', name: 'user_login', methods: ['POST'])]
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

            $user = $this->authService->authenticate(
                $content['email'],
                $content['password']
            );

            dd($user);

            return new JsonResponse([
                'id' => $user->id(),
                'email' => $user->email()->value(),
                'firstName' => $user->firstName(),
                'lastName' => $user->lastName()
            ]);

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
} 