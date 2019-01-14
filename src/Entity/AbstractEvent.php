<?php

namespace Pionyr\PionyrCz\Entity;

use Pionyr\PionyrCz\Constants\EventCategory;
use Pionyr\PionyrCz\Constants\EventLocalization;
use Pionyr\PionyrCz\Helper\DateTimeFactory;

class AbstractEvent
{
    use IdentifiableTrait;
    const LOCALIZATION_NATIONWIDE = 'Celorepubliková';
    /** @var string */
    protected $title;
    /** @var string */
    protected $description;
    /** @var EventCategory|null */
    protected $category;
    /** @var string|null */
    protected $photoUrl;
    /** @var string */
    protected $organizer;
    /** @var \DateTimeImmutable */
    protected $dateFrom;
    /** @var \DateTimeImmutable */
    protected $dateTo;
    /** @var bool */
    protected $isImportant;
    /** @var string */
    protected $place;
    /** @var string */
    protected $region;
    /** @var string */
    protected $websiteUrl;
    /** @var string|null */
    protected $priceForMembers;
    /** @var string|null */
    protected $priceForMembersDiscounted;
    /** @var string|null */
    protected $priceForPublic;
    /** @var string|null */
    protected $priceForPublicDiscounted;
    /** @var \DateTimeImmutable|null */
    protected $datePublishFrom;
    /** @var \DateTimeImmutable|null */
    protected $datePublishTo;
    /** @var EventLocalization|null */
    protected $localization;
    /** @var bool */
    protected $isShownInCalendar;
    /** @var bool */
    protected $isOpenEvent;
    /** @var string|null */
    protected $openEventType;
    /** @var bool */
    protected $isForKids;
    /** @var bool */
    protected $isForLeaders;
    /** @var bool */
    protected $isForPublic;

    protected function __construct()
    {
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }

    public function getOrganizer()
    {
        return $this->organizer;
    }

    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    public function getDateTo()
    {
        return $this->dateTo;
    }

    public function isImportant()
    {
        return $this->isImportant;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getWebsiteUrl()
    {
        return $this->websiteUrl;
    }

    public function getPriceForMembers()
    {
        return $this->priceForMembers;
    }

    public function getPriceForMembersDiscounted()
    {
        return $this->priceForMembersDiscounted;
    }

    public function getPriceForPublic()
    {
        return $this->priceForPublic;
    }

    public function getPriceForPublicDiscounted()
    {
        return $this->priceForPublicDiscounted;
    }

    public function getLocalization()
    {
        return $this->localization;
    }

    public function getDatePublishFrom()
    {
        return $this->datePublishFrom;
    }

    public function getDatePublishTo()
    {
        return $this->datePublishTo;
    }

    public function isShownInCalendar()
    {
        return $this->isShownInCalendar;
    }

    public function isOpenEvent()
    {
        return $this->isOpenEvent;
    }

    public function getOpenEventType()
    {
        return $this->openEventType;
    }

    public function isForKids()
    {
        return $this->isForKids;
    }

    public function isForLeaders()
    {
        return $this->isForLeaders;
    }

    public function isForPublic()
    {
        return $this->isForPublic;
    }

    protected static function setCommonEventResponseDataToObject(\stdClass $responseData, self $object)
    {
        $object->setUuidFromString($responseData->guid);
        $object->title = $responseData->nazev;
        $object->description = $responseData->popis;
        $object->setCategory($responseData->typAkceId);
        $object->photoUrl = $responseData->logoUrl;
        $object->organizer = $responseData->poradatel;
        $object->dateFrom = DateTimeFactory::fromInputString($responseData->terminOd . ' ' . $responseData->casOd);
        $object->dateTo = DateTimeFactory::fromInputString($responseData->terminDo . ' ' . $responseData->casDo);
        $object->isImportant = $responseData->jeDulezityTermin;
        $object->place = $responseData->mistoKonani;
        $object->region = $responseData->kraj;
        $object->websiteUrl = $responseData->web ?: '';
        $object->priceForMembers = $responseData->cenaStandardniCleni ?: null;
        $object->priceForMembersDiscounted = $responseData->cenaZvyhodnenaCleni ?: null;
        $object->priceForPublic = $responseData->cenaStandardniVerejnost ?: null;
        $object->priceForPublicDiscounted = $responseData->cenaZvyhodnenaVerejnost ?: null;
        $object->datePublishFrom = DateTimeFactory::fromNullableInputString($responseData->zverejnitOd);
        $object->datePublishTo = DateTimeFactory::fromNullableInputString($responseData->zverejnitDo);
        $object->setLocalizationFromString($responseData->lokalizace);
        $object->isShownInCalendar = $responseData->jeZobrazitVKalendariu;
        $object->isOpenEvent = $responseData->jeOtevrenaAkce;
        $object->openEventType = $responseData->typOtevreneAkce ?: null;
        $object->isForKids = $responseData->jeProDeti;
        $object->isForLeaders = $responseData->jeProVedouci;
        $object->isForPublic = $responseData->jeProVerejnost;
    }

    protected function setCategory($categoryId)
    {
        if (EventCategory::isValid($categoryId)) {
            $this->category = new EventCategory($categoryId);
        }
    }

    protected function setLocalizationFromString($localization = null)
    {
        if ($localization === 'Regionální') {
            $this->localization = new EventLocalization(EventLocalization::REGIONAL);
        } elseif ($localization === 'Celorepubliková') {
            $this->localization = new EventLocalization(EventLocalization::NATIONWIDE);
        }
    }
}
