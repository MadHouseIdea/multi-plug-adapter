<?php

namespace MadHouseIdeas\Lib\MultiPlugAdapter\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

use MadHouseIdeas\Lib\MultiPlugAdapter\Interface\RequestParamsInterface;

class MovieTweetingsApi
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
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
                $requestParams()->getRoute(),
                $requestParams()->getQuery(),
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

