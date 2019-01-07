<?php

namespace Pionyr\PionyrCz\Http\Response;

abstract class AbstractListResponse implements ResponseInterface
{
    /** @var int */
    protected $pageCount;
    /** @var int */
    protected $itemTotalCount;

    protected function __construct(array $data, $pageCount, $itemTotalCount)
    {
        $this->setData($data);
        $this->pageCount = $pageCount;
        $this->itemTotalCount = $itemTotalCount;
    }

    /** @return int */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /** @return int */
    public function getItemTotalCount()
    {
        return $this->itemTotalCount;
    }

    abstract protected function setData(array $data);
}
