<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Security;

use App\Users\Domain\Service\TokenGeneratorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

final class JWTAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private readonly TokenGeneratorInterface $tokenGenerator
    ) {
    }

    public function supports(Request $request): ?bool
    {
        return $request->headers->has('Authorization');
    }

    public function authenticate(Request $request): Passport
    {
        $token = $this->extractToken($request);
        
        if (!$token) {
            throw new CustomUserMessageAuthenticationException('No token provided');
        }

        $payload = $this->tokenGenerator->validate($token);
        
        if (!$payload) {
            throw new CustomUserMessageAuthenticationException('Invalid token');
        }

        return new SelfValidatingPassport(
            new UserBadge($payload['email'])
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse(
            ['error' => $exception->getMessage()],
            Response::HTTP_UNAUTHORIZED
        );
    }

    private function extractToken(Request $request): ?string
    {
        $authHeader = $request->headers->get('Authorization');
        return str_starts_with($authHeader, 'Bearer ') ? substr($authHeader, 7) : null;
    }
} 