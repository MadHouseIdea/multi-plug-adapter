<?php

namespace MadHouseIdeas\Lib\MultiPlugAdapter\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

use MadHouseIdeas\Lib\MultiPlugAdapter\Contracts\RequestParamsInterface;

class MultiPlugAdapterApi
{
    protected $client;
    protected $adapter;
    protected $requestParams;

    public function __construct(
        Client $client,
        $adapter,
        RequestParamsInterface $requestParams
    )
    {
        $this->client  = $client;
        $this->adapter = $adapter;
        $this->requestParams = $requestParams;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function findAll()
    {
        try {
            $response = $this->getClient()->request(
                'GET',
                $this->requestParams->getRoute(),
                $this->requestParams->getQuery()
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
        if ($response->getStatusCode() != BaseResponse::HTTP_OK) {
            return false;
        }

        return !empty($response->getBody()->getContents());
    }
}

