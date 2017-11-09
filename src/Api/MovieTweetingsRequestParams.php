<?php

namespace MadHouseIdeas\Lib\MultiPlugAdapter\Api;

use MadHouseIdeas\Lib\MultiPlugAdapter\Interfaces\RequestParamsInterface;

class MovieTweetingsRequestParams implements RequestParamsInterface
{
    protected $route;
    protected $query;

    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getRoute()
    {
        return $this->route;
    }
}
