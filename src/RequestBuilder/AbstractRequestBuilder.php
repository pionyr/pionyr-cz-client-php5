<?php

namespace Pionyr\PionyrCz\RequestBuilder;

use Fig\Http\Message\RequestMethodInterface;
use Pionyr\PionyrCz\Exception\ResponseDecodingException;
use Pionyr\PionyrCz\Http\RequestManager;

abstract class AbstractRequestBuilder
{
    /** @var RequestManager */
    private $requestManager;

    public function __construct(RequestManager $requestManager)
    {
        $this->requestManager = $requestManager;
    }

    public function send()
    {
        $response = $this->requestManager->sendRequest(RequestMethodInterface::METHOD_GET, $this->getPath(), $this->getQueryParams());
        $responseData = $this->readDataFromResponse($response);

        return $this->processResponse($responseData);
    }

    /**
     * Request endpoint path (with leading and trailing slash)
     */
    abstract protected function getPath();

    /**
     * Query params to be added to endpoint URL
     *
     * @codeCoverageIgnore
     */
    protected function getQueryParams()
    {
        return [];
    }

    abstract protected function processResponse(\stdClass $responseData);

    private function readDataFromResponse(\Psr\Http\Message\ResponseInterface $response)
    {
        $responseData = json_decode($response->getBody()->getContents());
        if (json_last_error() !== JSON_ERROR_NONE || !$responseData instanceof \stdClass) {
            throw ResponseDecodingException::forJsonError(json_last_error_msg(), $response);
        }

        return $responseData;
    }
}
