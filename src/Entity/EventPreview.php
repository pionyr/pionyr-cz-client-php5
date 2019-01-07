<?php

namespace Pionyr\PionyrCz\Entity;

class EventPreview extends AbstractEvent
{
    public static function createFromResponseData(\stdClass $responseData)
    {
        $object = new static();
        static::setCommonEventResponseDataToObject($responseData, $object);

        return $object;
    }

    /**
     * @param array $responseDataArray
     * @return EventPreview[]
     */
    public static function createFromResponseDataArray(array $responseDataArray)
    {
        $entities = [];
        foreach ($responseDataArray as $responseData) {
            $entities[] = self::createFromResponseData($responseData);
        }

        return $entities;
    }
}
