<?php

namespace Pionyr\PionyrCz\Entity;

class EventDetail extends AbstractEvent
{
    /** @var Photo[] */
    protected $photos = [];
    /** @var File[] */
    protected $files = [];
    /** @var Link[] */
    protected $links = [];
    /** @var int|null */
    protected $ageFrom;
    /** @var int|null */
    protected $ageTo;
    /** @var int|null */
    protected $expectedNumberOfParticipants;
    /** @var string|null */
    protected $transportation;
    /** @var string|null */
    protected $accommodation;
    /** @var string|null */
    protected $food;
    /** @var string */
    protected $requiredEquipment;

    public static function createFromResponseData(\stdClass $responseData)
    {
        $object = new static();
        static::setCommonEventResponseDataToObject($responseData, $object);
        $object->ageFrom = $responseData->vekOd !== null ? (int) $responseData->vekOd : null;
        $object->ageTo = $responseData->vekDo !== null ? (int) $responseData->vekDo : null;
        $object->expectedNumberOfParticipants = $responseData->predpokladanyPocetUcastniku !== null ? (int) $responseData->predpokladanyPocetUcastniku : null;
        $object->transportation = $responseData->doprava;
        $object->accommodation = $responseData->ubytovani;
        $object->food = $responseData->strava;
        $object->requiredEquipment = $responseData->pozadovaneVybaveni;
        $object->setPhotos($responseData->fotografie);
        $object->setFiles($responseData->soubory);
        $object->setLinks($responseData->odkazy);

        return $object;
    }

    public function getAgeFrom()
    {
        return $this->ageFrom;
    }

    public function getAgeTo()
    {
        return $this->ageTo;
    }

    public function getExpectedNumberOfParticipants()
    {
        return $this->expectedNumberOfParticipants;
    }

    public function getTransportation()
    {
        return $this->transportation;
    }

    public function getAccommodation()
    {
        return $this->accommodation;
    }

    public function getFood()
    {
        return $this->food;
    }

    public function getRequiredEquipment()
    {
        return $this->requiredEquipment;
    }

    /**
     * @return Photo[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @return File[]
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return Link[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    private function setPhotos(array $photos)
    {
        foreach ($photos as $photo) {
            $this->photos[] = Photo::create($photo->url, $photo->popisek);
        }
    }

    private function setFiles(array $files)
    {
        foreach ($files as $file) {
            $this->files[] = File::create($file->url, $file->nazev, $file->jeVerejne);
        }
    }

    private function setLinks(array $links)
    {
        foreach ($links as $link) {
            $this->links[] = Link::create($link->url, $link->titulek);
        }
    }
}
