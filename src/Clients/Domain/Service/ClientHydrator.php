<?php

namespace App\Clients\Domain\Service;

use App\Clients\Domain\Entity\Client;

class ClientHydrator
{


    public function hydrateFromArray(array $data, Client $client): Client
    {
     
        
        return $client;
    }

    /**
     * Mergea los datos de la entidad origen en la entidad destino
     * preservando los valores específicos que no queremos sobrescribir
     */
    public function hydrate(Client $source, Client $target): Client
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