<?php

namespace Pionyr\PionyrCz\Http\Response;

use Assert\Assertion;
use Pionyr\PionyrCz\Entity\EventPreview;

class EventsResponse extends AbstractListResponse
{
    /** @var EventPreview[] */
    private $data;

    public static function create(array $data, $pageCount, $itemTotalCount)
    {
        return new static($data, $pageCount, $itemTotalCount);
    }

    /**
     * @return EventPreview[]
     */
    public function getData()
    {
        return $this->data;
    }

    protected function setData(array $data)
    {
        Assertion::allIsInstanceOf($data, EventPreview::class);
        $this->data = $data;
    }
}
