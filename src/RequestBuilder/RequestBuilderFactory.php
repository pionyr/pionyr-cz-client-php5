<?php

namespace Pionyr\PionyrCz\RequestBuilder;

use PascalDeVink\ShortUuid\ShortUuid;
use Pionyr\PionyrCz\Http\RequestManager;
use Ramsey\Uuid\Uuid;

class RequestBuilderFactory
{
    /** @var RequestManager */
    private $requestManager;

    public function __construct(RequestManager $requestManager)
    {
        $this->requestManager = $requestManager;
    }

    public function articles()
    {
        return new ArticlesRequestBuilder($this->requestManager);
    }

    public function article($uuidOrShortUuid)
    {
        return new ArticleRequestBuilder($this->requestManager, $this->getUuidFromString($uuidOrShortUuid));
    }

    public function events()
    {
        return new EventsRequestBuilder($this->requestManager);
    }

    public function event($uuidOrShortUuid)
    {
        return new EventRequestBuilder($this->requestManager, $this->getUuidFromString($uuidOrShortUuid));
    }

    public function groups()
    {
        return new GroupsRequestBuilder($this->requestManager);
    }

    protected function getUuidFromString($uuidOrShortUuid)
    {
        if (mb_strlen($uuidOrShortUuid) === 36) {
            $uuidString = $uuidOrShortUuid;
        } else {
            $shortUuid = new ShortUuid();
            $uuidString = $shortUuid->decode($uuidOrShortUuid)->toString();
        }

        return Uuid::fromString($uuidString);
    }
}
