<?php

namespace Pionyr\PionyrCz\Entity;

class Address
{
    /** @var string */
    private $city;
    /** @var string */
    private $street;
    /** @var string */
    private $postcode;

    protected function __construct($city, $street, $postcode)
    {
        $this->city = $city;
        $this->street = $street;
        $this->postcode = $postcode;
    }

    public static function create($city, $street, $postcode)
    {
        return new static($city, $street, $postcode);
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }
}
