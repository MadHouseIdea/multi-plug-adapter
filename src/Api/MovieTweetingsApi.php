<?php

namespace MadHouseIdeas\Lib\MultiPlugAdapter\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

use MadHouseIdeas\Lib\MultiPlugAdapter\Interfaces\RequestParamsInterface;

class MovieTweetingsApi
{
    protected $client;
    protected $adapter;

    public function __construct(Client $client, $adapter)
    {
        $this->client  = $client;
        $this->adapter = $adapter;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function findAll(RequestParamsInterface $requestParams)
    {
        try {
            $response = $this->getClient()->request(
                'GET',
                $requestParams->getRoute(),
                $requestParams->getQuery()
            );
        } catch (\Exception $e) {
            return [];
        }
        if (!$this->isValidResponse($response)){
            return [];
        }
        return $this->getAdapter()($response->getBody());
    }

    protected function isValidResponse($response)
    {
        if ($response->getStatusCode() != 200) {
            return false;
        }
        return !empty($response->getBody());
    }
}

