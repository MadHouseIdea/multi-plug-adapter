<?php

require __DIR__ . '/vendor/autoload.php';

use MadHouseIdeas\Lib\MultiPlugAdapter\Api\MovieTwetingsRequestParams;
use MadHouseIdeas\Lib\MultiPlugAdapter\Api\MovieTweetingsApi;
use MadHouseIdeas\Lib\MultiPlugAdapter\Adapters\MovieTwetingsAdapter;
use MadHouseIdeas\Lib\MultiPlugAdapter\Entities\MovieTwetingsEntity;

$requestParams = (new MovieTwetingsRequestParams)
    ->setRoute('https://raw.githubusercontent.com/sidooms/MovieTweetings/master/latest/movies.dat')
    ->setQuery(['sink' => 'test.csv']);

$adapter = new MovieTwetingsAdapter(new MovieTwetingsEntity);
$api = new MovieTweetingsApi(new GuzzleHttp\Client, $adapter);

$result = $api->findAll($requestParams);

var_dump($result);
