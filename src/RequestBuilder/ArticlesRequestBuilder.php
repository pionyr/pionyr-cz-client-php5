<?php

namespace Pionyr\PionyrCz\RequestBuilder;

use Pionyr\PionyrCz\Entity\ArticlePreview;
use Pionyr\PionyrCz\Http\Response\ArticlesResponse;

/** @method ArticlesResponse send() */
class ArticlesRequestBuilder extends AbstractRequestBuilder
{
    /** @var int|null */
    protected $page;
    /** @var int */
    protected $categoryId;
    /** @var bool */
    protected $onlyRegional = false;

    public function setPage($page = null)
    {
        $this->page = $page;

        return $this;
    }

    public function setCategory($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function onlyRegional($onlyRegional = true)
    {
        $this->onlyRegional = $onlyRegional;

        return $this;
    }

    protected function getPath()
    {
        return '/clanky/';
    }

    protected function getQueryParams()
    {
        $params = [];
        if ($this->page !== null) {
            $params['stranka'] = $this->page;
        }
        if ($this->categoryId !== null) {
            $params['kategorie'] = $this->categoryId;
        }
        if ($this->onlyRegional === true) {
            $params['krajske'] = '1';
        }

        return $params;
    }

    protected function processResponse(\stdClass $responseData)
    {
        $articles = ArticlePreview::createFromResponseDataArray((array) $responseData->seznam);

        return ArticlesResponse::create($articles, $responseData->celkemStranek, $responseData->celkemPolozek);
    }
}
