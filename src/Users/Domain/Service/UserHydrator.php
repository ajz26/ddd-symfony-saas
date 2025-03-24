<?php

namespace App\Users\Domain\Service;

use App\Users\Domain\Entity\User;
use App\Users\Domain\ValueObject\Email;
use App\Users\Domain\ValueObject\Password;
use App\Shared\Domain\ValueObject\ClientId;

class UserHydrator
{


    public function hydrateFromArray(array $data, User $user): User
    {
     
        $user->setEmail(Email::fromString($data['email']));
        $user->setPassword(Password::fromPlainPassword($data['password']));
        $user->setClientId(ClientId::fromString($data['clientId']));
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);

        return $user;
    }

    /**
     * Mergea los datos de la entidad origen en la entidad destino
     * preservando los valores específicos que no queremos sobrescribir
     */
    public function hydrate(User $source, User $target): User
    {

        $reflection = new \ReflectionClass($source);
        
        $properties = $reflection->getProperties();


        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();

            // Lista de propiedades que queremos preservar del target
            $preservedProperties = [
                'id',
                'createdAt',
            ];

            // Si la propiedad está en la lista de preservadas, la saltamos
            if (in_array($propertyName, $preservedProperties)) {
                continue;
            }


            $value = $property->getValue($source);
            $property->setValue($target, $value);
        }

        return $target;
    }
} 