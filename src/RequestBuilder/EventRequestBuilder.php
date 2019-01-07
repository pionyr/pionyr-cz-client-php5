<?php

namespace Pionyr\PionyrCz\RequestBuilder;

use Pionyr\PionyrCz\Entity\EventDetail;
use Pionyr\PionyrCz\Http\RequestManager;
use Pionyr\PionyrCz\Http\Response\EventResponse;
use Ramsey\Uuid\UuidInterface;

/** @method EventResponse send() */
class EventRequestBuilder extends AbstractRequestBuilder
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
        return '/akceDetail/';
    }

    protected function getQueryParams()
    {
        return ['guid' => $this->uuid->toString()];
    }

    protected function processResponse(\stdClass $responseData)
    {
        $event = EventDetail::createFromResponseData($responseData);

        return EventResponse::create($event);
    }
}
