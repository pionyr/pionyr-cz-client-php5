<?php

namespace Pionyr\PionyrCz\RequestBuilder;

use Pionyr\PionyrCz\Entity\Group;
use Pionyr\PionyrCz\Http\Response\GroupsResponse;

/** @method GroupsResponse send() */
class GroupsRequestBuilder extends AbstractRequestBuilder
{
    /** @var int|null */
    protected $page;

    public function setPage($page = null)
    {
        $this->page = $page;

        return $this;
    }

    protected function getPath()
    {
        return '/ps/';
    }

    protected function getQueryParams()
    {
        $params = [];
        if ($this->page !== null) {
            $params['stranka'] = $this->page;
        }

        return $params;
    }

    protected function processResponse(\stdClass $responseData)
    {
        $groups = Group::createFromResponseDataArray((array) $responseData->seznam);

        return GroupsResponse::create($groups, $responseData->celkemStranek, $responseData->celkemPolozek);
    }
}
