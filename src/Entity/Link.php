<?php

namespace Pionyr\PionyrCz\Entity;

class Link
{
    /** @var string */
    private $url;
    /** @var string */
    private $title;

    protected function __construct($url, $title)
    {
        $this->url = $url;
        $this->title = $title;
    }

    public static function create($url, $title)
    {
        return new static($url, $title);
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
