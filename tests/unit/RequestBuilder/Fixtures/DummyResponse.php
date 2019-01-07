<?php

namespace Pionyr\PionyrCz\RequestBuilder\Fixtures;

use Pionyr\PionyrCz\Http\Response\ResponseInterface;

class DummyResponse implements ResponseInterface
{
    public function getData()
    {
        return [];
    }
}
