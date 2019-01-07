<?php

namespace Pionyr\PionyrCz\Entity;

use Pionyr\PionyrCz\Helper\DateTimeFactory;

class AbstractArticle
{
    use IdentifiableTrait;
    /** @var string */
    protected $title;
    /** @var \DateTimeImmutable */
    protected $datePublished;
    /** @var string */
    protected $category;
    /** @var int */
    protected $categoryId;
    /** @var string */
    protected $authorName;
    /** @var string */
    protected $perex;
    /** @var string|null */
    protected $perexPhotoUrl;

    protected function __construct()
    {
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDatePublished()
    {
        return $this->datePublished;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getAuthorName()
    {
        return $this->authorName;
    }

    public function getPerex()
    {
        return $this->perex;
    }

    public function getPerexPhotoUrl()
    {
        return $this->perexPhotoUrl;
    }

    protected static function setCommonArticleResponseDataToObject(\stdClass $responseData, self $object)
    {
        $object->setUuidFromString($responseData->guid);
        $object->title = $responseData->nazev;
        $object->datePublished = DateTimeFactory::fromInputString($responseData->datumPublikovani);
        $object->setCategory($responseData->kategorie, $responseData->kategorieId);
        $object->setAuthorName($responseData->autorJmeno, $responseData->autorPrijmeni);
        $object->perex = $responseData->perex;
        $object->perexPhotoUrl = $responseData->perexUrl;
    }

    protected function setAuthorName($firstName = '', $secondName = '')
    {
        $this->authorName = trim($firstName . ' ' . $secondName);
    }

    protected function setCategory($category, $categoryId)
    {
        $this->category = $category;
        $this->categoryId = $categoryId;
    }
}
