<?php

namespace Pionyr\PionyrCz\Entity;

class File
{
    /** @var string */
    private $url;
    /** @var string */
    private $title;
    /** @var bool */
    private $isPublic;

    protected function __construct($url, $title, $isPublic)
    {
        $this->url = $url;
        $this->title = $title;
        $this->isPublic = $isPublic;
    }

    public static function create($url, $title, $isPublic)
    {
        return new static($url, $title, $isPublic);
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function isPublic()
    {
        return $this->isPublic;
    }
}
