<?php

namespace Pionyr\PionyrCz\Entity;

use Pionyr\PionyrCz\Constants\Region;
use Pionyr\PionyrCz\Helper\DateTimeFactory;

class ArticleDetail extends AbstractArticle
{
    /** @var string */
    protected $text;
    /** @var string|null */
    protected $textPhotoUrl;
    /** @var \DateTimeImmutable|null */
    protected $dateShowFrom;
    /** @var \DateTimeImmutable|null */
    protected $dateShowTo;
    /** @var bool */
    protected $isNews;
    /** @var bool */
    protected $isNewsForMembersPublic;
    /** @var bool */
    protected $isNewsForMembersPrivate;
    /** @var bool */
    protected $isMyRegion;
    /** @var bool */
    protected $isMozaika;
    /** @var bool */
    protected $isOfferedToOtherRegions;
    /** @var Region[] */
    protected $regions = [];
    /** @var Photo[] */
    protected $photos = [];
    /** @var Link[] */
    protected $links = [];

    public static function createFromResponseData(\stdClass $responseData)
    {
        $object = new static();
        static::setCommonArticleResponseDataToObject($responseData, $object);
        $object->text = $responseData->text;
        $object->textPhotoUrl = $responseData->textUrl;
        $object->dateShowFrom = DateTimeFactory::fromNullableInputString($responseData->datumZobrazitOd);
        $object->dateShowTo = DateTimeFactory::fromNullableInputString($responseData->datumZobrazitDo);
        $object->isNews = $responseData->jeAktualita;
        $object->isNewsForMembersPublic = $responseData->jeProClenyVerejna;
        $object->isNewsForMembersPrivate = $responseData->jeProClenyNeverejna;
        $object->isMyRegion = $responseData->jeMujKrajskyWeb;
        $object->isMozaika = $responseData->jeMozaika;
        $object->isOfferedToOtherRegions = $responseData->jeNabidnutDalsim;
        $object->setRegions($responseData);
        $object->setPhotos($responseData->fotografie);
        $object->setLinks($responseData->odkazy);

        return $object;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getTextPhotoUrl()
    {
        return $this->textPhotoUrl;
    }

    public function getDateShowFrom()
    {
        return $this->dateShowFrom;
    }

    public function getDateShowTo()
    {
        return $this->dateShowTo;
    }

    public function isNews()
    {
        return $this->isNews;
    }

    public function isNewsForMembersPublic()
    {
        return $this->isNewsForMembersPublic;
    }

    public function isNewsForMembersPrivate()
    {
        return $this->isNewsForMembersPrivate;
    }

    public function isMyRegion()
    {
        return $this->isMyRegion;
    }

    public function isMozaika()
    {
        return $this->isMozaika;
    }

    public function isOfferedToOtherRegions()
    {
        return $this->isOfferedToOtherRegions;
    }

    /**
     * @return Region[]
     */
    public function getRegions()
    {
        return $this->regions;
    }

    /**
     * @return Photo[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @return Link[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    private function setRegions(\stdClass $responseData)
    {
        $availableRegions = Region::toArray();
        foreach ($availableRegions as $regionShortcut) {
            if (!empty($responseData->{'je' . $regionShortcut})) {
                $this->regions[$regionShortcut] = Region::$regionShortcut();
            }
        }
    }

    private function setPhotos(array $photos)
    {
        foreach ($photos as $photo) {
            $this->photos[] = Photo::create($photo->url, $photo->popisek);
        }
    }

    private function setLinks(array $links)
    {
        foreach ($links as $link) {
            $this->links[] = Link::create($link->url, $link->titulek);
        }
    }
}
