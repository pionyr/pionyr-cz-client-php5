<?php

namespace Pionyr\PionyrCz\Http\Response;

use Pionyr\PionyrCz\Entity\ArticleDetail;

class ArticleResponse implements ResponseInterface
{
    /** @var ArticleDetail */
    private $data;

    private function __construct(ArticleDetail $data)
    {
        $this->data = $data;
    }

    public static function create(ArticleDetail $data)
    {
        return new static($data);
    }

    public function getData()
    {
        return $this->data;
    }
}
