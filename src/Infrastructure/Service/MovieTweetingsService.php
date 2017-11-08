<?php

namespace MadHouseIdeas\Lib\MultiPlugAdapter\Infrastructure\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

use MadHouseIdeas\Lib\MultiPlugAdapter\Interface\RequestParamsInterface;

class MovieTweetingsService
{
    protected $client;
    protected $requestParams;

    public function __construct(Client $client, RequestParamsInterface $requestParams)
    {
        $this->client        = $client;
        $this->requestParams = $requestParams;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getRequestParams()
    {
        return $this->requestParams;
    }

    public function findAll()
    {
        try {
            $response = $this->getClient()->request(
                'GET',
                $this->getRequestParams()->getRoute(),
                $this->getRequestParams()->getQuery(),
            );
        } catch (\Exception $e) {
            return [];
        }
        if (!$this->isValidResponse($response)){
            return [];
        }
        return json_decode($response->getBody(), true);
    }

    protected function isValidResponse($response)
    {
        if ($response->getStatusCode() != 200) {
            return false;
        }
        $body = json_decode($response->getBody(), true);
        return !empty($body);
    }
}

