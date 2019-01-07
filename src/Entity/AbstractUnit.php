<?php

namespace Pionyr\PionyrCz\Entity;

class AbstractUnit
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $websiteUrl;
    /** @var string */
    protected $phone;
    /** @var string */
    protected $email;
    /** @var string */
    protected $leaderName;

    protected function __construct()
    {
    }

    public function getName()
    {
        return $this->name;
    }

    public function getWebsiteUrl()
    {
        return $this->websiteUrl;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getLeaderName()
    {
        return $this->leaderName;
    }

    protected static function setCommonUnitResponseDataToObject(\stdClass $responseData, self $object)
    {
        $object->name = $responseData->nazev;
        $object->setLeaderName($responseData->vedouciJmeno, $responseData->vedouciPrijmeni);
        $object->websiteUrl = $responseData->web;
        $object->phone = $responseData->telefon;
        $object->email = $responseData->email;
    }

    protected function setLeaderName($firstName = '', $secondName = '')
    {
        $this->leaderName = trim($firstName . ' ' . $secondName);
    }
}
