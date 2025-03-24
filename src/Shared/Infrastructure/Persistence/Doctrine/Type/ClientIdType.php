<?php 

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Type;

use App\Shared\Domain\ValueObject\ClientId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class ClientIdType extends StringType
{
    public const NAME = 'client_id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        return $value instanceof ClientId ? $value->value() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?ClientId
    {
        return $value ? new ClientId($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
} 