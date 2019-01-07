<?php

namespace Pionyr\PionyrCz\Http\Response;

use Assert\Assertion;
use Pionyr\PionyrCz\Entity\ArticlePreview;

class ArticlesResponse extends AbstractListResponse
{
    /** @var ArticlePreview[] */
    private $data;

    public static function create(array $data, $pageCount, $itemTotalCount)
    {
        return new static($data, $pageCount, $itemTotalCount);
    }

    /**
     * @return ArticlePreview[]
     */
    public function getData()
    {
        return $this->data;
    }

    protected function setData(array $data)
    {
        Assertion::allIsInstanceOf($data, ArticlePreview::class);
        $this->data = $data;
    }
}
