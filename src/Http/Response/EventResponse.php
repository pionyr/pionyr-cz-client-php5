<?php

namespace Pionyr\PionyrCz\Http\Response;

use Pionyr\PionyrCz\Entity\EventDetail;

class EventResponse implements ResponseInterface
{
    /** @var EventDetail */
    private $data;

    private function __construct(EventDetail $data)
    {
        $this->data = $data;
    }

    public static function create(EventDetail $data)
    {
        return new static($data);
    }

    public function getData()
    {
        return $this->data;
    }
}
