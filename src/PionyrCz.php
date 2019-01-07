<?php

namespace Pionyr\PionyrCz;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Pionyr\PionyrCz\Http\RequestManager;
use Pionyr\PionyrCz\RequestBuilder\RequestBuilderFactory;

class PionyrCz
{
    /** @var string */
    private $apiToken;
    /** @var RequestManager */
    private $requestManager;

    public function __construct($apiToken)
    {
        $this->apiToken = $apiToken;
        $this->requestManager = new RequestManager($apiToken);
    }

    public function request()
    {
        return new RequestBuilderFactory($this->getRequestManager());
    }

    /** @return $this */
    public function setBaseUrl($baseUrl)
    {
        $this->getRequestManager()->setBaseUrl($baseUrl);

        return $this;
    }

    /** @return $this */
    public function setHttpClient(HttpClient $client)
    {
        $this->getRequestManager()->setHttpClient($client);

        return $this;
    }

    /**
     * @codeCoverageIgnore
     * @param MessageFactory $messageFactory
     * @return $this
     */
    public function setHttpMessageFactory(MessageFactory $messageFactory)
    {
        $this->getRequestManager()->setMessageFactory($messageFactory);

        return $this;
    }

    protected function getRequestManager()
    {
        return $this->requestManager;
    }
}
