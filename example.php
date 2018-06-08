<?php

require __DIR__ . '/vendor/autoload.php';

use MadHouseIdeas\Lib\MultiPlugAdapter\Api\MovieTweetingsRequestParams;
use MadHouseIdeas\Lib\MultiPlugAdapter\Api\MultiPlugAdapterApi;
use MadHouseIdeas\Lib\MultiPlugAdapter\Adapters\MovieTweetingsAdapter;
use MadHouseIdeas\Lib\MultiPlugAdapter\Entities\MovieTweetingsEntity;

$client = new GuzzleHttp\Client;
$adapter = new MovieTweetingsAdapter(new MovieTweetingsEntity);
$requestParams = new MovieTweetingsRequestParams;

$api = new MultiPlugAdapterApi($client, $adapter, $requestParams);

$result = $api->findAll();

var_dump($result);
