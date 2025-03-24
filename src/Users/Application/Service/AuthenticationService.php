<?php

declare(strict_types=1);

namespace App\Users\Application\Service;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use App\Users\Domain\ValueObject\Email;
use App\Users\Domain\Exception\InvalidCredentialsException;
use App\Users\Domain\Service\TokenGeneratorInterface;

final class AuthenticationService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly TokenGeneratorInterface $tokenGenerator
    ) {
    }

    /**
     * Autentica un usuario y genera un token JWT
     * 
     * @throws InvalidCredentialsException si las credenciales son inválidas
     */
    public function authenticate(string $email, string $plainPassword): array
    {
        // Buscar usuario por email
        $user = $this->userRepository->findByEmail(Email::fromString($email));

        if ($user === null) {
            throw new InvalidCredentialsException('Credenciales inválidas');
        }

        // Verificar contraseña
        if (!$user->verifyPassword($plainPassword)) {
            throw new InvalidCredentialsException('Credenciales inválidas');
        }

        // Generar token JWT
        $token = $this->tokenGenerator->generate($user);

        // Retornar respuesta con token y datos del usuario
        return [
            'token' => $token,
            'user' => $this->formatUserResponse($user)
        ];
    }

    /**
     * Refresca el token JWT de un usuario
     */
    public function refreshToken(User $user): string
    {
        return $this->tokenGenerator->generate($user);
    }

    /**
     * Valida un token JWT
     */
    public function validateToken(string $token): ?array
    {
        return $this->tokenGenerator->validate($token);
    }

    /**
     * Formatea la respuesta del usuario para la API
     */
    private function formatUserResponse(User $user): array
    {
        return [
            'id' => $user->id(),
            'email' => $user->email()->value(),
            'firstName' => $user->firstName(),
            'lastName' => $user->lastName(),
            'fullName' => $user->fullName()
        ];
    }
} 