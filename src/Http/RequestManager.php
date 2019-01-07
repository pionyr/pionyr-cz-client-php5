<?php

namespace Pionyr\PionyrCz\Http;

use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\HeaderSetPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\Authentication\QueryParam;
use Http\Message\MessageFactory;
use Pionyr\PionyrCz\Http\Plugin\ExceptionPlugin;

/**
 * Encapsulates HTTP layer, ie. request/response handling.
 * This class should not be typically used directly.
 */
class RequestManager
{
    /** @var string */
    private $baseUrl = 'https://pionyr.cz/api';
    /** @var string */
    protected $apiToken;
    /** @var HttpClient */
    protected $httpClient;
    /** @var MessageFactory */
    protected $messageFactory;

    public function __construct($apiToken)
    {
        $this->apiToken = $apiToken;
    }

    public function sendRequest($method, $path, array $queryParams = [])
    {
        $httpRequest = $this->createHttpRequest($method, $path, $queryParams);
        $client = $this->createConfiguredHttpClient();
        // TODO: handle exceptions (or create custom plugin?)
        return $client->sendRequest($httpRequest);
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /** @codeCoverageIgnore */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /** @codeCoverageIgnore */
    public function setMessageFactory(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    protected function getHttpClient()
    {
        if ($this->httpClient === null) {
            // @codeCoverageIgnoreStart
            $this->httpClient = HttpClientDiscovery::find();
            // @codeCoverageIgnoreEnd
        }

        return $this->httpClient;
    }

    protected function getMessageFactory()
    {
        if ($this->messageFactory === null) {
            $this->messageFactory = MessageFactoryDiscovery::find();
        }

        return $this->messageFactory;
    }

    protected function createConfiguredHttpClient()
    {
        return new PluginClient($this->getHttpClient(), [new RedirectPlugin(), new HeaderSetPlugin($this->getDefaultHeaders()), new AuthenticationPlugin(new QueryParam(['token' => $this->apiToken])), new ExceptionPlugin()]);
    }

    protected function createHttpRequest($method, $path, array $queryParams = [])
    {
        $uri = $this->baseUrl . $path;
        $queryString = http_build_query($queryParams, '', '&');
        if (!empty($queryString)) {
            $uri .= '?' . $queryString;
        }

        return $this->getMessageFactory()->createRequest($method, $uri);
    }

    protected function getDefaultHeaders()
    {
        return ['Accept' => 'application/json'];
    }
}
