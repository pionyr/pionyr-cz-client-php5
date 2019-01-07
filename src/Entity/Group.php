<?php

namespace Pionyr\PionyrCz\Entity;

class Group extends AbstractUnit
{
    /** @var Address */
    protected $addressOfficial;
    /** @var Address */
    protected $addressWhereToFindUs;

    public static function createFromResponseData(\stdClass $responseData)
    {
        $object = new static();
        static::setCommonUnitResponseDataToObject($responseData, $object);
        $object->setAddressOfficial($responseData->adresaSidla);
        $object->setAddressWhereToFindUs($responseData->adresaKdeNasNajdete);

        return $object;
    }

    public function getAddressOfficial()
    {
        return $this->addressOfficial;
    }

    public function getAddressWhereToFindUs()
    {
        return $this->addressWhereToFindUs;
    }

    /**
     * @param array $responseDataArray
     * @return Group[]
     */
    public static function createFromResponseDataArray(array $responseDataArray)
    {
        $entities = [];
        foreach ($responseDataArray as $responseData) {
            $entities[] = self::createFromResponseData($responseData);
        }

        return $entities;
    }

    private function setAddressOfficial(\stdClass $address)
    {
        $this->addressOfficial = Address::create($address->mesto, $address->ulice, $address->psc);
    }

    private function setAddressWhereToFindUs(\stdClass $address)
    {
        $this->addressWhereToFindUs = Address::create($address->mesto, $address->ulice, $address->psc);
    }
}
