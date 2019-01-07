<?php

namespace Pionyr\PionyrCz\RequestBuilder;

use Pionyr\PionyrCz\Entity\ArticleDetail;
use Pionyr\PionyrCz\Http\RequestManager;
use Pionyr\PionyrCz\Http\Response\ArticleResponse;
use Ramsey\Uuid\UuidInterface;

/** @method ArticleResponse send() */
class ArticleRequestBuilder extends AbstractRequestBuilder
{
    /** @var UuidInterface */
    protected $uuid;

    public function __construct(RequestManager $requestManager, UuidInterface $uuid)
    {
        parent::__construct($requestManager);
        $this->uuid = $uuid;
    }

    protected function getPath()
    {
        return '/clanekDetail/';
    }

    protected function getQueryParams()
    {
        return ['guid' => $this->uuid->toString()];
    }

    protected function processResponse(\stdClass $responseData)
    {
        $article = ArticleDetail::createFromResponseData($responseData);

        return ArticleResponse::create($article);
    }
}
