<?php

namespace MadHouseIdeas\Lib\MultiPlugAdapter\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

use MadHouseIdeas\Lib\MultiPlugAdapter\Api\MovieTweetingsApi;
use MadHouseIdeas\Lib\MultiPlugAdapter\Adapters\MovieTweetingsAdapter;
use MadHouseIdeas\Lib\MultiPlugAdapter\Entities\MovieTweetingsEntity;
use MadHouseIdeas\Lib\MultiPlugAdapter\Api\MovieTweetingsRequestParams;

class MovieTweetingsApiTest extends TestCase
{

    /**
     * @test
     */
    public function shouldReturnAnEmptyArrayWhenDoesNotHaveAValidResponse()
    {
        $mock = new MockHandler([
            new Response(BaseResponse::HTTP_NO_CONTENT, []),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $requestParams = (new MovieTweetingsRequestParams)
            ->setRoute('')
            ->setQuery([]);


        $adapter = new MovieTweetingsAdapter(new MovieTweetingsEntity);
        $api = new MovieTweetingsApi($client, $adapter);

        $this->assertEmpty($api->findAll($requestParams));
    }

    /**
     * @test
     */
    public function shouldReturnAnEmptyArrayWhenReturnServerError()
    {
        $mock = new MockHandler([
            new Response(BaseResponse::HTTP_INTERNAL_SERVER_ERROR, []),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $requestParams = (new MovieTweetingsRequestParams)
            ->setRoute('')
            ->setQuery([]);


        $adapter = new MovieTweetingsAdapter(new MovieTweetingsEntity);
        $api = new MovieTweetingsApi($client, $adapter);

        $this->assertEmpty($api->findAll($requestParams));
    }

    /**
     * @test
     */
    public function shouldReturnAnEmptyArrayWhenReturnAnEmptyBodyResponse()
    {

        $mock = new MockHandler([
           new Response(BaseResponse::HTTP_OK, [], ""),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $requestParams = (new MovieTweetingsRequestParams)
            ->setRoute('')
            ->setQuery([]);


        $adapter = new MovieTweetingsAdapter(new MovieTweetingsEntity);
        $api = new MovieTweetingsApi($client, $adapter);

        $this->assertEmpty($api->findAll($requestParams));
    }

    /**
     * @test
     */
    public function shouldReturnAResponseWhenTheStatusIsOkAndHasBodyResponse()
    {

        $responseRequest = "00007::Foo::Bar";
        $expectedResponse = explode($responseRequest, '::');

        $mock = new MockHandler([
           new Response(BaseResponse::HTTP_OK, [], $responseRequest),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $requestParams = (new MovieTweetingsRequestParams)
            ->setRoute('')
            ->setQuery([]);

        $adapter = $this->getMockBuilder('AdapterInvokableInterface')
            ->disableOriginalConstructor()
            ->setMethods(['__invoke'])
            ->getMock();

        $adapter->expects($this->any())
            ->method('__invoke')
            ->willReturn($expectedResponse);


        $api = new MovieTweetingsApi($client, $adapter);

        $this->assertEquals($expectedResponse, $api->findAll($requestParams));
    }
}
