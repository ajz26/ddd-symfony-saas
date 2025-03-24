<?php 

declare(strict_types=1);

namespace App\Shared\Infrastructure\ArgumentResolver;

use App\Clients\Domain\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use App\Shared\Infrastructure\Attribute\CurrentClient;
use App\Shared\Infrastructure\Service\CurrentClientProvider;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class CurrentClientResolver implements ValueResolverInterface
{
    public function __construct(
        private readonly CurrentClientProvider $clientProvider
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if (Client::class !== $argument->getType()) {
            return [];
        }

        if (!$argument->getAttributes(CurrentClient::class)) {
            return [];
        }

        yield $this->clientProvider->getClient();
    }
} 