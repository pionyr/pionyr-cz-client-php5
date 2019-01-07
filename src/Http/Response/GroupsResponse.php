<?php

namespace Pionyr\PionyrCz\Http\Response;

use Assert\Assertion;
use Pionyr\PionyrCz\Entity\Group;

class GroupsResponse extends AbstractListResponse
{
    /** @var Group[] */
    private $data;

    public static function create(array $data, $pageCount, $itemTotalCount)
    {
        return new static($data, $pageCount, $itemTotalCount);
    }

    /**
     * @return Group[]
     */
    public function getData()
    {
        return $this->data;
    }

    protected function setData(array $data)
    {
        Assertion::allIsInstanceOf($data, Group::class);
        $this->data = $data;
    }
}
