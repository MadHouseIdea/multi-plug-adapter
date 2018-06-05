<?php

require __DIR__ . '/vendor/autoload.php';

use MadHouseIdeas\Lib\MultiPlugAdapter\Api\MovieTweetingsRequestParams;
use MadHouseIdeas\Lib\MultiPlugAdapter\Api\MovieTweetingsApi;
use MadHouseIdeas\Lib\MultiPlugAdapter\Adapters\MovieTweetingsAdapter;
use MadHouseIdeas\Lib\MultiPlugAdapter\Entities\MovieTweetingsEntity;

$requestParams = (new MovieTweetingsRequestParams)
    ->setRoute('https://raw.githubusercontent.com/sidooms/MovieTweetings/master/latest/movies.dat')
    ->setQuery([]);

$adapter = new MovieTweetingsAdapter(new MovieTweetingsEntity);
$api = new MovieTweetingsApi(new GuzzleHttp\Client, $adapter, $requestParams);

$result = $api->findAll();

var_dump($result);
