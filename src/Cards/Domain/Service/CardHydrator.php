<?php

namespace App\Cards\Domain\Service;

use App\Cards\Domain\Entity\Card;

class CardHydrator
{


    public function hydrateFromArray(array $data, Card $card): Card
    {
     
        
        return $card;
    }

    /**
     * Mergea los datos de la entidad origen en la entidad destino
     * preservando los valores específicos que no queremos sobrescribir
     */
    public function hydrate(Card $source, Card $target): Card
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
                'customDescription',
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