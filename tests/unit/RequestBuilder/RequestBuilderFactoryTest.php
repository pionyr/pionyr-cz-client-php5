<?php

namespace Pionyr\PionyrCz\RequestBuilder;

use Fig\Http\Message\RequestMethodInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Pionyr\PionyrCz\Http\RequestManager;
use Pionyr\PionyrCz\Http\Response\ArticleResponse;
use Pionyr\PionyrCz\Http\Response\ArticlesResponse;
use Pionyr\PionyrCz\Http\Response\EventResponse;
use Pionyr\PionyrCz\Http\Response\EventsResponse;
use Pionyr\PionyrCz\Http\Response\GroupsResponse;

/**
 * @covers \Pionyr\PionyrCz\RequestBuilder\RequestBuilderFactory
 */
class RequestBuilderFactoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideBuilderMethods
     * @param mixed $factoryMethod
     * @param array $factoryArguments
     * @param mixed $expectedBuilderClass
     * @param mixed $expectedResponseClass
     * @param mixed $responseFile
     */
    public function shouldInstantiateBuilderAndSendRequest($factoryMethod, array $factoryArguments, $expectedBuilderClass, $expectedResponseClass, $responseFile)
    {
        $requestManagerMock = $this->createMock(RequestManager::class);
        $requestManagerMock->expects($this->once())->method('sendRequest')->with(RequestMethodInterface::METHOD_GET, $this->isType('string'))->willReturn(new Response(200, [], file_get_contents($responseFile)));
        $factory = new RequestBuilderFactory($requestManagerMock);
        /** @var AbstractRequestBuilder $builder */
        $builder = $factory->{$factoryMethod}(...$factoryArguments);
        $this->assertInstanceOf($expectedBuilderClass, $builder);
        $this->assertInstanceOf($expectedResponseClass, $builder->send());
    }

    /**
     * @return array[]
     */
    public function provideBuilderMethods()
    {
        return [['articles', [], ArticlesRequestBuilder::class, ArticlesResponse::class, __DIR__ . '/../Http/Fixtures/articles-response.json'], ['article', ['e7e976ca-2f87-4dc9-bb51-a5fd17ff0905'], ArticleRequestBuilder::class, ArticleResponse::class, __DIR__ . '/../Http/Fixtures/article-response.json'], ['events', [], EventsRequestBuilder::class, EventsResponse::class, __DIR__ . '/../Http/Fixtures/events-response.json'], ['event', ['8cec671b-88c0-11e8-8c1c-00155dfe3279'], EventRequestBuilder::class, EventResponse::class, __DIR__ . '/../Http/Fixtures/event-response.json'], ['groups', [], GroupsRequestBuilder::class, GroupsResponse::class, __DIR__ . '/../Http/Fixtures/groups-response.json']];
    }

    /**
     * @test
     * @dataProvider provideUuid
     * @param mixed $passedId
     * @param mixed $expectedUuid
     */
    public function shouldConvertShortUuidToUuidIdentifier($passedId, $expectedUuid)
    {
        $requestManagerMock = $this->createMock(RequestManager::class);
        $requestManagerMock->expects($this->once())->method('sendRequest')->with($this->anything(), $this->anything(), $this->equalTo(['guid' => $expectedUuid]))->willReturn(new Response(200, [], file_get_contents(__DIR__ . '/../Http/Fixtures/article-response.json')));
        $factory = new RequestBuilderFactory($requestManagerMock);
        $factory->article($passedId)->send();
    }

    /**
     * @return array[]
     */
    public function provideUuid()
    {
        return [['e7e976ca-2f87-4dc9-bb51-a5fd17ff0905', 'e7e976ca-2f87-4dc9-bb51-a5fd17ff0905'], ['Nf4YnUiTdBCPvXybAbNwGj', 'e7e976ca-2f87-4dc9-bb51-a5fd17ff0905']];
    }
}
