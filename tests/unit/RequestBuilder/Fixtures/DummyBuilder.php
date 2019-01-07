<?php

namespace Pionyr\PionyrCz\RequestBuilder\Fixtures;

use Pionyr\PionyrCz\Http\Response\ResponseInterface;
use Pionyr\PionyrCz\RequestBuilder\AbstractRequestBuilder;

class DummyBuilder extends AbstractRequestBuilder
{
    /**
     * @return string
     */
    protected function getPath()
    {
        return '/';
    }

    /*
     * @return \Pionyr\PionyrCz\Http\Response\ResponseInterface
     */
    protected function processResponse(\stdClass $responseData)
    {
        return new DummyResponse();
    }
}
